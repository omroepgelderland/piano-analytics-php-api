#!/bin/bash

if [[ $(git rev-parse --abbrev-ref HEAD) != "master" ]]; then
    echo "Not on branch master"
    exit 1
fi

./deploy_dev.sh || exit 1

if [ -n "$(git status --untracked-files=no --porcelain)" ]; then
    git status
    echo "Er zijn uncommitted changes. Toch doorgaan? (j/n)"
    read -r ans
    if [[ $ans != "j" ]]; then
        exit 1
    fi
fi

# versieverhoging
oude_versie="$(git tag --list --sort=v:refname | grep -P '^\d+\.\d+\.\d+' | tail -n1)"
echo "De huidige versie is $oude_versie. Versieverhoging? (major|minor|patch|premajor|preminor|prepatch|prerelease) "
read -r versie_type
nieuwe_versie="$(semver -i "$versie_type" "$oude_versie")"

git tag "$nieuwe_versie" || exit 1
git push origin || exit 1
git push origin "$nieuwe_versie" || exit 1
