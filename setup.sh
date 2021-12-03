#!/bin/bash

dirName="api-tp05"
repoName="$dirName-keller-guillaume"

heroku login
heroku create $repoName

git add .
git commit -m "first commit"

heroku git:remote -a $repoName

git push heroku master -f