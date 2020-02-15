<?hh // strict

namespace __Private;

// This file is not intended to be included in this repository.
// It will be provided by a different repo, because of references.
// Licensed under MIT, owner Lexidor Digital (me)
class Ref<T>{
	public function __construct(public T $value) { }
}

function fb_intercept_full(
	string $name,
	?(function(string, mixed, varray<mixed>, mixed, Ref<bool>): mixed) $handler,
	mixed $data = null,
): bool {
	if ($handler === null || $handler === '') {
		/*HH_IGNORE_ERROR[2049] no hhi*/
		/*HH_IGNORE_ERROR[4107] no hhi*/
		return \fb_intercept($name, null);
	} else {
		invariant($name !== '', 'Using the catch-all intercept is not supported');
		/*HH_IGNORE_ERROR[2049] no hhi*/
		/*HH_IGNORE_ERROR[4107] no hhi*/
		return \fb_intercept(
			$name,
			(
				string $name,
				mixed $obj_or_classname,
				varray<mixed> $arguments,
				mixed $data,
				/*HH_IGNORE_ERROR[2087] Don't use references*/
			bool &$done,
			) ==> {
				if (!\is_callable($handler)) {
					\trigger_error(
						'The given handler could not be called!',
						\E_USER_WARNING,
					);
					return null;
				}
				$done_ref = new Ref($done ? true : false);
				$ret = $handler($name, $obj_or_classname, $arguments, $data, $done_ref);
				$done = $done_ref->value;
				return $ret;
			},
			$data,
		);
	}
}

function fb_intercept_four(
	string $name,
	?(function(string, mixed, varray<mixed>, mixed): mixed) $handler,
	mixed $data = null,
): bool {
	if ($handler === null || $handler === '') {
		/*HH_IGNORE_ERROR[2049] no hhi*/
		/*HH_IGNORE_ERROR[4107] no hhi*/
		return \fb_intercept($name, null);
	} else {
		invariant($name !== '', 'Using the catch-all intercept is not supported');
		/*HH_IGNORE_ERROR[2049] no hhi*/
		/*HH_IGNORE_ERROR[4107] no hhi*/
		return \fb_intercept(
			$name,
			(
				string $name,
				mixed $obj_or_classname,
				varray<mixed> $arguments,
				mixed $data,
				/*HH_IGNORE_ERROR[2087] Don't use references*/
			bool &$_done,
			) ==> {
				if (!\is_callable($handler)) {
					\trigger_error(
						'The given handler could not be called!',
						\E_USER_WARNING,
					);
					return null;
				}
				return $handler($name, $obj_or_classname, $arguments, $data);
			},
			$data,
		);
	}
}

function fb_intercept_three(
	string $name,
	?(function(string, mixed, varray<mixed>): mixed) $handler,
	mixed $data = null,
): bool {
	if ($handler === null || $handler === '') {
		/*HH_IGNORE_ERROR[2049] no hhi*/
		/*HH_IGNORE_ERROR[4107] no hhi*/
		return \fb_intercept($name, null);
	} else {
		invariant($name !== '', 'Using the catch-all intercept is not supported');
		/*HH_IGNORE_ERROR[2049] no hhi*/
		/*HH_IGNORE_ERROR[4107] no hhi*/
		return \fb_intercept(
			$name,
			(
				string $name,
				mixed $obj_or_classname,
				varray<mixed> $arguments,
				mixed $_data,
				/*HH_IGNORE_ERROR[2087] Don't use references*/
			bool &$_done,
			) ==> {
				if (!\is_callable($handler)) {
					\trigger_error(
						'The given handler could not be called!',
						\E_USER_WARNING,
					);
					return null;
				}
				return $handler($name, $obj_or_classname, $arguments);
			},
			$data,
		);
	}
}

function fb_intercept_two(
	string $name,
	?(function(string, mixed): mixed) $handler,
	mixed $data = null,
): bool {
	if ($handler === null || $handler === '') {
		/*HH_IGNORE_ERROR[2049] no hhi*/
		/*HH_IGNORE_ERROR[4107] no hhi*/
		return \fb_intercept($name, null);
	} else {
		invariant($name !== '', 'Using the catch-all intercept is not supported');
		/*HH_IGNORE_ERROR[2049] no hhi*/
		/*HH_IGNORE_ERROR[4107] no hhi*/
		return \fb_intercept(
			$name,
			(
				string $name,
				mixed $obj_or_classname,
				varray<mixed> $_arguments,
				mixed $_data,
				/*HH_IGNORE_ERROR[2087] Don't use references*/
			bool &$_done,
			) ==> {
				if (!\is_callable($handler)) {
					\trigger_error(
						'The given handler could not be called!',
						\E_USER_WARNING,
					);
					return null;
				}
				return $handler($name, $obj_or_classname);
			},
			$data,
		);
	}
}

function fb_intercept_one(
	string $name,
	?(function(string): mixed) $handler,
	mixed $data = null,
): bool {
	if ($handler === null || $handler === '') {
		/*HH_IGNORE_ERROR[2049] no hhi*/
		/*HH_IGNORE_ERROR[4107] no hhi*/
		return \fb_intercept($name, null);
	} else {
		invariant($name !== '', 'Using the catch-all intercept is not supported');
		/*HH_IGNORE_ERROR[2049] no hhi*/
		/*HH_IGNORE_ERROR[4107] no hhi*/
		return \fb_intercept(
			$name,
			(
				string $name,
				mixed $_obj_or_classname,
				varray<mixed> $_arguments,
				mixed $_data,
				/*HH_IGNORE_ERROR[2087] Don't use references*/
			bool &$_done,
			) ==> {
				if (!\is_callable($handler)) {
					\trigger_error(
						'The given handler could not be called!',
						\E_USER_WARNING,
					);
					return null;
				}
				return $handler($name);
			},
			$data,
		);
	}
}

function fb_intercept_zero(
	string $name,
	?(function(): mixed) $handler,
	mixed $data = null,
): bool {
	if ($handler === null || $handler === '') {
		/*HH_IGNORE_ERROR[2049] no hhi*/
		/*HH_IGNORE_ERROR[4107] no hhi*/
		return \fb_intercept($name, null);
	} else {
		invariant($name !== '', 'Using the catch-all intercept is not supported');
		/*HH_IGNORE_ERROR[2049] no hhi*/
		/*HH_IGNORE_ERROR[4107] no hhi*/
		return \fb_intercept(
			$name,
			(
				string $_name,
				mixed $_obj_or_classname,
				varray<mixed> $_arguments,
				mixed $_data,
				/*HH_IGNORE_ERROR[2087] Don't use references*/
			bool &$_done,
			) ==> {
				if (!\is_callable($handler)) {
					\trigger_error(
						'The given handler could not be called!',
						\E_USER_WARNING,
					);
					return null;
				}
				return $handler();
			},
			$data,
		);
	}
}
