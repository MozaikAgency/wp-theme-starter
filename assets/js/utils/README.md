# JS Utils

Utils **when imported or required** must not directly affect the page/site/app
in any way. Instead they are intended to be used/utilized as needed by the other
scripts in your application.

As such, utils must always export one or more methods that can optionally be
imported and invoked by the other scripts of the app.

#### Example:

##### Bad Util:
```javascript
const els = $('[data-eq-heights]').toArray();

// when evaluated, the following code
// will immediately affect the DOM!
// This is fine for a "script", but not
// fine at all for a "util"
const naturalMaxHeight = els
  .forEach(el => $(el).css('min-height', 0))
  .reduce((max, {outerHeight}) => outerHeight > max ? outerHeight : max, 0);

els.forEach(el => $(el).css('min-height', naturalMaxHeight + 'px'));
```
##### Good Util
```javascript
// This is a util, it is re-usable and
// it can be invoked as needed by other
// scripts in your app. By itself it
// does nothing :)
export default function eqheights(selector) {
  const els = $(selector).toArray();

  const naturalMaxHeight = els
    .forEach(el => $(el).css('min-height', 0))
    .reduce((max, {outerHeight}) => outerHeight > max ? outerHeight : max, 0);

  els.forEach(el => $(el).css('min-height', naturalMaxHeight + 'px'));
}
```


<small>_footnote: (shameless plug) you can find eqheights, without
the jQuery dependancy, on
[github](https://github.com/Maximilianos/eqheights)
and [npm](https://www.npmjs.com/package/eqheights)</small>