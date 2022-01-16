# Ackee Analytics for KirbyCMS

Plugin for KirbyCMS to generate dynamic tracking-scripts for [Ackee](https://ackee.electerious.com/).

## Plugin requirements

- PHP 7+
- KirbyCMS 3

## Setup

Clone the repository into your `site/plugins` folder.

```
# HTTPS
git clone https://github.com/Sociant/kirby-ackee-analytics.git

# SSH
git clone git@github.com:Sociant/kirby-ackee-analytics.git
```

Add the plugin to your submodules

```
# Open from root directory of your project
git submodule add https://github.com/Sociant/kirby-ackee-analytics.git site/plugins/ackee-analytics
```

Add the plugin to your template by adding this line to a header-element
```php
<html>
<head>
    <title>Your Title</title>
    <meta charset="UTF-8">

    <?php echo $page->ackeeHeader() ?>
    ...
```

Without any changes in the config you won't see a script because the extension is disabled by default.

To enable the extension, add the following line to your config.php (site/config/config.php):

```php
return [
    // your other options
    'sociant.ackee-analytics' => [
        'ackee-analytics-url' => 'https://your-ackee-sever.de',
        'tracker-file-name' => 'tracker.js',
        'enable-tracking' => true,
        'domain-id' => 'Your domain-id',

        // optional if you want to gather information about the language, device and screen resolution of the visitor
        'detailed' => true, 
        // optional if you want to track visitors from localhost
        'ignore-localhost' => false, 
        // optional if you want to track yourself (if you're logged into your ackee-server)
        'ignore-own-visits' => false, 
    ]
];
```

## Customization per template

You can easily change the behaviour of the plugin by extending the ackeeHeader method with options.

You dont have to add every option. If one option is not defined it will fallback to the page option or the global option.

```php
<html>
<head>
    <title>Your Title</title>
    <meta charset="UTF-8">

    <?php echo $page->ackeeHeader([
        'isEnabled' => true,
        'trackerFileName' => 'tracker.js',
        'analyticsUrl' => '',
        'domainId' => '',
        'detailed' => true,
        'ignoreLocalhost' => false,
        'ignoreOwnVisits' => false,
    ]) ?>
    ...
```

## Customization per page

As always you can edit the script by adding options to your page. You can add following identifiers to your blueprint to affect each page:

| key | function |
| --- | --- |
| ackeeTracking | to enable or disable tracking |
| ackeeTrackerFileName | the name of the tracker-file (usually 'tracker.js') |
| ackeeAnalyticsUrl | the url of the ackee-server |
| ackeeDomainId | the domain-id of your kirby-website |
| ackeeDetailed | to enable or disable detailed tracking |
| ackeeIgnoreLocalhost | to enable or disable tracking from localhost |
| ackeeIgnoreOwnVisits | to enable or disable tracking yourself (if you're logged into your ackee-server) |

Please note that the plugin prioritizes the template options over the page options. If none of them are defined it will always fallback to the global configuration.

## License

This plugin is an open-source software licensed under the [MIT license](https://opensource.org/licenses/mit-license.php).

Copyright © 2021 Sociant