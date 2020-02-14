<<__EntryPoint>>
async function main(): Awaitable<void> {
	require_once __DIR__.'/vendor/hh_autoload.hh';

	echo foo_la_la().\PHP_EOL;
	__Private\fb_intercept_full(
		'foo_la_la',
		(
			string $name,
			mixed $obj_or_classname,
			varray<mixed> $params,
			mixed $data,
			__Private\Ref<bool> $done,
		) ==> {
			$done->value = true;
			return 43;
		},
		null,
	);

	echo foo_la_la().\PHP_EOL;

}

function foo_la_la(): int {
	return 42;
}
