<?hh // strict

namespace __Private;

// This file is not intended to be included in this repository.
// It will be provided by a different repo, because of references.
// Licensed under MIT, owner Lexidor Digital (me)
class Ref<T> {
	public function __construct(public T $value) {}
}

function fb_intercept_full(
	string $name,
	?(function(string, mixed, varray<mixed>, mixed, Ref<bool>): mixed) $handler,
	mixed $data = null,
): bool {
	if ($handler === null || $handler === '') {
		/*HH_IGNORE_ERROR[2049] no hhi*/
    /*HH_IGNORE_ERROR[4107] no hhi*/
		return \fb_intercept2($name, null);
	} else {
		invariant($name !== '', 'Using the catch-all intercept is not supported');
		/*HH_IGNORE_ERROR[2049] no hhi*/
    /*HH_IGNORE_ERROR[4107] no hhi*/
		return \fb_intercept2($name, (
			string $name,
			mixed $obj_or_classname,
			inout varray<mixed> $params,
		) ==> {
			$done = new Ref(true);
			$ret = $handler($name, $obj_or_classname, $params, $data, $done);
			if ($done->value) {
				return shape('value' => $ret);
			} else {
				return shape();
			}
		});
	}
}

function fb_intercept_four(
	string $name,
	?(function(string, mixed, varray<mixed>, mixed): mixed) $handler,
	mixed $data = null,
): bool {
	if ($handler === null || $handler === '') {
		return \fb_intercept2($name, null);
	} else {
		invariant($name !== '', 'Using the catch-all intercept is not supported');

		return \fb_intercept2(
			$name,
			(string $name, mixed $obj_or_classname, inout varray<mixed> $params) ==>
				shape('value' => $handler($name, $obj_or_classname, $params, $data)),
		);
	}
}
function fb_intercept_three(
	string $name,
	?(function(string, mixed, varray<mixed>): mixed) $handler,
	mixed $data = null,
): bool {
	if ($handler === null || $handler === '') {
		return \fb_intercept2($name, null);
	} else {
		invariant($name !== '', 'Using the catch-all intercept is not supported');

		return \fb_intercept2(
			$name,
			(string $name, mixed $obj_or_classname, inout varray<mixed> $params) ==>
				shape('value' => $handler($name, $obj_or_classname, $params)),
		);
	}
}

function fb_intercept_two(
	string $name,
	?(function(string, mixed): mixed) $handler,
	mixed $data = null,
): bool {
	if ($handler === null || $handler === '') {
		return \fb_intercept2($name, null);
	} else {
		invariant($name !== '', 'Using the catch-all intercept is not supported');

		return \fb_intercept2(
			$name,
			(string $name, mixed $obj_or_classname, inout varray<mixed> $_) ==>
				shape('value' => $handler($name, $obj_or_classname)),
		);
	}
}

function fb_intercept_one(
	string $name,
	?(function(string): mixed) $handler,
	mixed $data = null,
): bool {
	if ($handler === null || $handler === '') {
		return \fb_intercept2($name, null);
	} else {
		invariant($name !== '', 'Using the catch-all intercept is not supported');

		return \fb_intercept2(
			$name,
			(string $name, mixed $_, inout varray<mixed> $_) ==>
				shape('value' => $handler($name)),
		);
	}
}

function fb_intercept_zero(
	string $name,
	?(function(): mixed) $handler,
	mixed $data = null,
): bool {
	if ($handler === null || $handler === '') {
		return \fb_intercept2($name, null);
	} else {
		invariant($name !== '', 'Using the catch-all intercept is not supported');

		return \fb_intercept2(
			$name,
			(string $a, mixed $_, inout varray<mixed> $_) ==>
				shape('value' => $handler()),
		);
	}
}
