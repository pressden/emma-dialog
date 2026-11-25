=== Emma Dialog ===
Contributors:      Eric Michel, D.S. Webster
Tags:              block, dialog, popup, modal
Requires at least: 6.3
Tested up to:      6.8
Stable tag:        1.1.0
License:           GPL-2.0-or-later
License URI:       https://www.gnu.org/licenses/gpl-2.0.html

A dialog/popup block for the Emma theme, built on the native HTML <dialog> element.

== Description ==

Add the "Emma Dialog" block to a page, or to a template part to show it site-wide, and build its content with any
blocks (image, text, HTML, buttons). The dialog has a close button, and Esc closes it.

Open options (block sidebar):

* **Open Link:** links pointing at this address (e.g. `#newsletter`) open the dialog when clicked.
* **Open On:** desktop, mobile or both. Mobile means a viewport 600px wide or less.
* **Open Automatically:** never, after a delay (seconds after page load), or on exit intent (mouse leaves the window;
  a fast scroll up on touch devices).

Automatic open settings:

* **Open Limit:** how many times the dialog may open automatically (0 = no limit).
* **Open Limit Expiration:** days after the last automatic open before the count resets (0 = never resets).
  Example: limit 1, expiration 30 = shown at most once every 30 days per browser.
* **Open Limit ID:** the key used to track the limit in the visitor's browser (localStorage).
* **Show dialog for:** logged-in visitors, logged-out visitors or both.

Add the class `wp-block-emma-dialog__close` to a link or form inside the dialog to close it, and
`prevent-dialog-auto-open` to stop the dialog from opening automatically again in that browser (for example on a
"No thanks" link or a submitted signup form).

== Open Limit ID ==

Each dialog gets a random ID when it's added, and a new one is generated if the field is cleared. Dialogs that share
an ID share one limit, which is useful for one campaign shown on several pages. A duplicated dialog keeps the
original's ID, so change it if the copy should be tracked separately. Dialogs saved without an ID fall back to the
block's HTML anchor, or a shared `emma-dialog` key.

== Known limitations ==

* Limits are stored per browser (localStorage): a new browser, private window or cleared storage shows the dialog again.
* The mobile/desktop breakpoint is fixed at 600px.
* Clicking outside the dialog doesn't close it.
* `prevent-dialog-auto-open` has no expiry.
* The block uses the experimental names of some design supports (`__experimentalBorder`, typography font settings).
  WordPress still accepts them, and they keep the controls working on older versions.

== Installation ==

1. Upload the plugin to `/wp-content/plugins/emma-dialog`, or install it from a zip.
2. Activate it on the Plugins screen.
3. Development: `npm ci`, then `npm run build` (the built `build/` folder is committed).

== Changelog ==

= 1.1.0 =
* Fix: the Open Limit Expiration never reset the open count (milliseconds compared with seconds), so a dialog that
  reached its limit never showed again.
* Fix: use addEventListener instead of replacing window.onload.
* Fix: an empty or missing Open Limit ID no longer shares `null-*` keys or writes an `undefined` key; the ID is
  generated in an effect and regenerated when cleared.
* Remove leftover console logging.
* Block API version 3; requires WordPress 6.3.

= 1.0 =
* Initial release.
