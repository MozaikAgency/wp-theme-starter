# WP Components

## What are components?

Components are php classes that group/namespace **static** methods
related to rendering a specific ui module. They are meant to be
configurable, reusable and composable. They are **not** meant to
be instanciated. They should generally have a `get_render` and
`render` method pair as their main way of use.

### Static

Component methods **MUST** be static to make them easier to use and compose.
Static methods imply that they do not depend on the given component being
instanciated. This means you can simply call the method directly, optionally
passing in any relevant parameters, and it will return or print the relevant
markup.

### Configurable

Component methods are simply like any other function. When defining a
Component method's signature you define its parameters and you can then
use those parameters within the method to return different markup or
values without having to rely on the current WordPress global state.

Offering a default behavior for your static methods that matches the
common use case is usually a good idea. The Component's consumer is
then not required to constantly pass in parameters unnecessarily.

### Reusable and Composable

Using a component within another component or element is great.
Keeping a component's scope as limited as possible and/or breaking
up a component's methods into smaller methods on the same component
makes it easier to reason about and reuse in your code.

## Differences with Elements

Elements (included using `get_template_part`) on the other hand are
simply templates that render a chunk of markup depending on the global
WordPress state at the time when the element was included. Their simplicity
makes them most widely applicable when developing sites and Component's are
in no way here to replace them. Components can simply do things that
elements cannot do and should only be used if you need at least one of
those things.

The limitations of Elements are:
First and foremost that they do not take arguments when being called.
As such they are not directly configurable, they render whatever they
render depending on the current global WordPress state.
The second thing Components can do that elements can't is to give the
ability to elegantly break up a given template into individually usable
subparts.

If you find yourself reaching for something that fits the above, then you
should probably consider using a Component to achieve what you are doing.

_Remember you should be able to easily compose Components into
Element templates_

## Differences with Library/Includes classes

Components are generally going to be less generic and more specific to the
visuals of the theme they are implementing than Library/Includes classes.
They are also restricted to describe UI modules/elements, Library/Includes
classes have no such restriction.

If you are making a collection of generic helper methods, or implementing
a specific functionality of a theme like ajax request handling for example;
then you should implement that as a Library/Includes class. If you are
working on how the markup of a given ui element is generated, then you
should use a Component.

_Remember you should be able to easily compose Components into
Library/Includes classes_
