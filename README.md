# c-helps

> Q&A for a specific github's company. Slack integration. Inspired by the stackoverflow.

## Setup

First, create a new github app, visit [GitHub's New Application page](https://github.com/settings/applications/new), fill out the form, and grab your client ID, secret and callback URL.

After that, create a new webhook slack service, visit [Slack New Webhook](https://my.slack.com/services/new/incoming-webhook/)

Finally fill the informations in the .env file

````php
GITHUB_ID=XXXXX
GITHUB_SECRET=XXXXXXXXXXXXXXXXXX
GITHUB_CALLBACK_URL=http://XXXXXXX/auth/github/callback

C-HELPS_COMPANY=name of your company, just like in the github (slug)

SLACK_WEBHOOK_URL=https://hooks.slack.com/services/XXX/XXX/XXX
SLACK_TO=#general //#channel or @direct messages
SLACK_ICON=:ghost: //slack icons or img
````