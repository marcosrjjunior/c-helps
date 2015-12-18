# c-helps

> Q&A for a specific github's company. Slack integration. Inspired by the stackoverflow.

## Setup

First, create a new github app, visit [GitHub's New Application page](https://github.com/settings/applications/new), fill out the form, and grab your client ID, secret and callback URL.

After that, create a new webhook slack service, visit [Slack New Webhook](https://my.slack.com/services/new/incoming-webhook/)

Finally fill the informations in the .env file

````
GITHUB_ID=XXXXX
GITHUB_SECRET=XXXXXXXXXXXXXXXXXX
GITHUB_CALLBACK_URL=http://XXXXXXX/auth/github/callback

GITHUB_ONLY_COMPANY=false // true: you'll can access if you belongs to a company. Company needs to be public in your profile
C-HELPS_COMPANY=name of your company, just like in the github (slug)

SLACK_WEBHOOK_URL=https://hooks.slack.com/services/XXX/XXX/XXX
SLACK_TO=#general //#channel or @direct messages
SLACK_ICON=:ghost: //slack icons or img
````

````
composer install
vendor/bin/homestead make
vagrant up
.../vagrant php artisan migrate
````

## Screenshots
<a href="#"><img src="https://cloud.githubusercontent.com/assets/5287262/11325827/4af65494-913f-11e5-9941-6f743c25b57b.png" alt="c-helps"></a>

<a href="#"><img src="https://cloud.githubusercontent.com/assets/5287262/11325774/c5254fba-913d-11e5-86c4-f628570afb8b.png" alt="c-helps"></a>

<a href="#"><img src="https://cloud.githubusercontent.com/assets/5287262/11325776/c9def434-913d-11e5-8141-74d26b5bda18.png" alt="c-helps"></a>
