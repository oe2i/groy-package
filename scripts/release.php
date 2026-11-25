<?php

declare(strict_types=1);

$allowedBranch = 'spartan';
$currentBranch = trim((string) shell_exec('git rev-parse --abbrev-ref HEAD'));

if ($currentBranch !== $allowedBranch) {
    fwrite(STDERR, "Releases can only be created from '{$allowedBranch}' (currently on '{$currentBranch}').\n");
    exit(1);
}

$bump = $argv[1] ?? null;
$preFlag = $argv[2] ?? null;
$preMap = ['--alpha' => 'alpha', '--beta' => 'beta', '--rc' => 'rc'];
$preType = $preMap[$preFlag] ?? null;

if (! in_array($bump, ['major', 'minor', 'patch'], true) || ($preFlag !== null && $preType === null)) {
    fwrite(STDERR, "Usage: composer release -- <major|minor|patch> [--alpha|--beta|--rc]\n");
    exit(1);
}

$latestTag = trim((string) shell_exec('git describe --tags --abbrev=0 2>NUL'));

if ($latestTag === '') {
    $newTag = $preType !== null ? "v1.0.0-{$preType}.1" : 'v1.0.0';
} elseif (preg_match('/^v(\d+)\.(\d+)\.(\d+)(?:-(alpha|beta|rc)\.(\d+))?$/', $latestTag, $matches) === 1) {
    $major = (int) $matches[1];
    $minor = (int) $matches[2];
    $patch = (int) $matches[3];
    $currentPre = $matches[4] ?? null;
    $currentPreNum = isset($matches[5]) ? (int) $matches[5] : null;

    if ($currentPre !== null) {
        if ($preType === null) {
            $newTag = "v{$major}.{$minor}.{$patch}";
        } elseif ($preType === $currentPre) {
            $nextPreNum = ($currentPreNum ?? 0) + 1;
            $newTag = "v{$major}.{$minor}.{$patch}-{$preType}.{$nextPreNum}";
        } else {
            $newTag = "v{$major}.{$minor}.{$patch}-{$preType}.1";
        }
    } else {
        match ($bump) {
            'major' => [$major++, $minor = 0, $patch = 0],
            'minor' => [$minor++, $patch = 0],
            'patch' => $patch++,
        };

        $newTag = $preType !== null
            ? "v{$major}.{$minor}.{$patch}-{$preType}.1"
            : "v{$major}.{$minor}.{$patch}";
    }
} else {
    fwrite(STDERR, "Latest tag '{$latestTag}' is not a valid semver tag (expected vX.Y.Z or vX.Y.Z-alpha|beta|rc.N).\n");
    exit(1);
}

echo "Bumping {$bump}: ".($latestTag !== '' ? $latestTag : 'none')." -> {$newTag}\n";

passthru("git tag -a {$newTag} -m \"Release {$newTag}\"", $tagExit);
if ($tagExit !== 0) {
    fwrite(STDERR, "Failed to create git tag {$newTag}.\n");
    exit($tagExit);
}

passthru("git push origin {$newTag}", $pushExit);
if ($pushExit !== 0) {
    fwrite(STDERR, "Failed to push git tag {$newTag}.\n");
    exit($pushExit);
}

if ($preType !== null) {
    passthru("gh release create {$newTag} --prerelease --generate-notes", $ghExit);
    if ($ghExit !== 0) {
        fwrite(STDERR, "Tag {$newTag} was pushed, but creating the GitHub Release failed (ensure 'gh' CLI is installed and authenticated).\n");
    }
} elseif (in_array($bump, ['minor', 'major'], true)) {
    passthru("gh release create {$newTag} --latest --generate-notes", $ghExit);
    if ($ghExit !== 0) {
        fwrite(STDERR, "Tag {$newTag} was pushed, but creating the GitHub Release failed (ensure 'gh' CLI is installed and authenticated).\n");
    }
}

echo "Released {$newTag} successfully.\n";
