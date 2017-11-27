#!/bin/bash
set -e # Exit with nonzero exit code if anything fails

RELEASE=$1

if [[ -n "$RELEASE" ]]; then
    echo DEPLOY RELEASE=$RELEASE
    echo "RELEASE="$RELEASE > .env
    docker-compose -f docker-compose.yml up -d
    docker ps
else
    echo "argument error"
fi
