# silverstripe-csshelpers

Applies an extension to `SiteTree` that provides css hooks for your template, based on user state (logged in/out/etc) and current page meta information (class, class hierarchy, url-segment/route).

Intended as a cheap and easy method of adding sometimes-useful css hooks to your `<body>` element.

Two variables are made available to templates:

* `$BodyCSSClass`
* `$BodyCSSID`

FWIW, the classes generated are based on an aged version of my own blend of BEM ... so, there's that. I'm definitely open to standardising them at some point, or allowing them to be set via static config (somehow?) at some stage.

## Requirements

SilverStripe 4

## Installation

`composer require fromholdio/silverstripe-csshelpers`

## Details

`$BodyCSSID` is generated using the prefix `page-` and the full url-segment of the current page (i.e. it includes the route hierarchy / urlsegment's of parent pages too).

```
Sample $BodyCSSID: "page-blog-article-name"
```

`$BodyCSSClass` is generated using:

* `Body` is added as initial part of return string
* The page's parents are looped, adding `Body--<urlsegment>` for each (allowing css-targeting of specific area of site)
* The class hierarchy of the page is looped, adding `class-<classname>` for each, stopping at `class-page`
* Current controller action is added: `action-<actionname>`
* Logged in status is added: `logged-[in|out]`

```php
Sample $BodyCSSClass: "Body Body--blog Body--blog--article-name class-blogpost class-page action-index logged-out"
```

## Disclaimer

Yep. Sometimes this kind of targeting with CSS hooks based on URL segments that the user can update in the CMS on a whim (through your fault or theirs 😉), is a hideous and terrible mistake.

But sometimes it's just the right tool for the job in front of you.
