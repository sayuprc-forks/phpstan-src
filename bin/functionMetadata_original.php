<?php declare(strict_types = 1);

return [
	'abs' => ['hasSideEffects' => false],
	'acos' => ['hasSideEffects' => false],
	'acosh' => ['hasSideEffects' => false],
	'addcslashes' => ['hasSideEffects' => false],
	'addslashes' => ['hasSideEffects' => false],
	'array_change_key_case' => ['hasSideEffects' => false],
	'array_chunk' => ['hasSideEffects' => false],
	'array_column' => ['hasSideEffects' => false],
	'array_combine' => ['hasSideEffects' => false],
	'array_count_values' => ['hasSideEffects' => false],
	'array_diff' => ['hasSideEffects' => false],
	'array_diff_assoc' => ['hasSideEffects' => false],
	'array_diff_key' => ['hasSideEffects' => false],
	'array_diff_uassoc' => ['hasSideEffects' => false],
	'array_diff_ukey' => ['hasSideEffects' => false],
	'array_fill' => ['hasSideEffects' => false],
	'array_fill_keys' => ['hasSideEffects' => false],
	'array_flip' => ['hasSideEffects' => false],
	'array_intersect' => ['hasSideEffects' => false],
	'array_intersect_assoc' => ['hasSideEffects' => false],
	'array_intersect_key' => ['hasSideEffects' => false],
	'array_intersect_uassoc' => ['hasSideEffects' => false],
	'array_intersect_ukey' => ['hasSideEffects' => false],
	'array_key_first' => ['hasSideEffects' => false],
	'array_key_last' => ['hasSideEffects' => false],
	'array_key_exists' => ['hasSideEffects' => false],
	'array_keys' => ['hasSideEffects' => false],
	'array_merge' => ['hasSideEffects' => false],
	'array_merge_recursive' => ['hasSideEffects' => false],
	'array_pad' => ['hasSideEffects' => false],
	'array_pop' => ['hasSideEffects' => true],
	'array_product' => ['hasSideEffects' => false],
	'array_push' => ['hasSideEffects' => true],
	'array_rand' => ['hasSideEffects' => false],
	'array_replace' => ['hasSideEffects' => false],
	'array_replace_recursive' => ['hasSideEffects' => false],
	'array_reverse' => ['hasSideEffects' => false],
	'array_shift' => ['hasSideEffects' => true],
	'array_slice' => ['hasSideEffects' => false],
	'array_sum' => ['hasSideEffects' => false],
	'array_udiff' => ['hasSideEffects' => false],
	'array_udiff_assoc' => ['hasSideEffects' => false],
	'array_udiff_uassoc' => ['hasSideEffects' => false],
	'array_uintersect' => ['hasSideEffects' => false],
	'array_uintersect_assoc' => ['hasSideEffects' => false],
	'array_uintersect_uassoc' => ['hasSideEffects' => false],
	'array_unique' => ['hasSideEffects' => false],
	'array_unshift' => ['hasSideEffects' => true],
	'array_values' => ['hasSideEffects' => false],
	'asin' => ['hasSideEffects' => false],
	'asinh' => ['hasSideEffects' => false],
	'atan' => ['hasSideEffects' => false],
	'atan2' => ['hasSideEffects' => false],
	'atanh' => ['hasSideEffects' => false],
	'base64_decode' => ['hasSideEffects' => false],
	'base64_encode' => ['hasSideEffects' => false],
	'base_convert' => ['hasSideEffects' => false],
	'basename' => ['hasSideEffects' => false],
	'bcadd' => ['hasSideEffects' => false],
	'bccomp' => ['hasSideEffects' => false],
	'bcdiv' => ['hasSideEffects' => false],
	'bcmod' => ['hasSideEffects' => false],
	'bcmul' => ['hasSideEffects' => false],
	// continue functionMap.php, line 424
	'chgrp' => ['hasSideEffects' => true],
	'chmod' => ['hasSideEffects' => true],
	'chown' => ['hasSideEffects' => true],
	'copy' => ['hasSideEffects' => true],
	'count' => ['hasSideEffects' => false],
	'connection_aborted' => ['hasSideEffects' => true],
	'connection_status' => ['hasSideEffects' => true],
	'error_log' => ['hasSideEffects' => true],
	'fclose' => ['hasSideEffects' => true],
	'fflush' => ['hasSideEffects' => true],
	'fgetc' => ['hasSideEffects' => true],
	'fgetcsv' => ['hasSideEffects' => true],
	'fgets' => ['hasSideEffects' => true],
	'fgetss' => ['hasSideEffects' => true],
	'file_get_contents' => ['hasSideEffects' => true],
	'file_put_contents' => ['hasSideEffects' => true],
	'flock' => ['hasSideEffects' => true],
	'fopen' => ['hasSideEffects' => true],
	'fpassthru' => ['hasSideEffects' => true],
	'fputcsv' => ['hasSideEffects' => true],
	'fputs' => ['hasSideEffects' => true],
	'fread' => ['hasSideEffects' => true],
	'fscanf' => ['hasSideEffects' => true],
	'fseek' => ['hasSideEffects' => true],
	'ftruncate' => ['hasSideEffects' => true],
	'fwrite' => ['hasSideEffects' => true],
	'json_validate' => ['hasSideEffects' => false],
	'lchgrp' => ['hasSideEffects' => true],
	'lchown' => ['hasSideEffects' => true],
	'link' => ['hasSideEffects' => true],
	'mb_str_pad' => ['hasSideEffects' => false],
	'mkdir' => ['hasSideEffects' => true],
	'move_uploaded_file' => ['hasSideEffects' => true],
	'pclose' => ['hasSideEffects' => true],
	'popen' => ['hasSideEffects' => true],
	'readfile' => ['hasSideEffects' => true],
	'rename' => ['hasSideEffects' => true],
	'rewind' => ['hasSideEffects' => true],
	'rmdir' => ['hasSideEffects' => true],
	'sprintf' => ['hasSideEffects' => false],
	'str_decrement' => ['hasSideEffects' => false],
	'str_increment' => ['hasSideEffects' => false],
	'symlink' => ['hasSideEffects' => true],
	'tempnam' => ['hasSideEffects' => true],
	'tmpfile' => ['hasSideEffects' => true],
	'touch' => ['hasSideEffects' => true],
	'umask' => ['hasSideEffects' => true],
	'unlink' => ['hasSideEffects' => true],

	// random functions, do not have side effects but are not deterministic
	'mt_rand' => ['hasSideEffects' => true],
	'rand' => ['hasSideEffects' => true],
	'random_bytes' => ['hasSideEffects' => true],
	'random_int' => ['hasSideEffects' => true],

	// methods
	'DateTime::createFromFormat' => ['hasSideEffects' => false],
	'DateTime::createFromImmutable' => ['hasSideEffects' => false],
	'DateTime::getLastErrors' => ['hasSideEffects' => false],
	'DateTime::add' => ['hasSideEffects' => true],
	'DateTime::modify' => ['hasSideEffects' => true],
	'DateTime::setDate' => ['hasSideEffects' => true],
	'DateTime::setISODate' => ['hasSideEffects' => true],
	'DateTime::setTime' => ['hasSideEffects' => true],
	'DateTime::setTimestamp' => ['hasSideEffects' => true],
	'DateTime::setTimezone' => ['hasSideEffects' => true],
	'DateTime::sub' => ['hasSideEffects' => true],
	'DateTime::diff' => ['hasSideEffects' => false],
	'DateTime::format' => ['hasSideEffects' => false],
	'DateTime::getOffset' => ['hasSideEffects' => false],
	'DateTime::getTimestamp' => ['hasSideEffects' => false],
	'DateTime::getTimezone' => ['hasSideEffects' => false],

	'DateTimeImmutable::createFromFormat' => ['hasSideEffects' => false],
	'DateTimeImmutable::createFromMutable' => ['hasSideEffects' => false],
	'DateTimeImmutable::getLastErrors' => ['hasSideEffects' => false],
	'DateTimeImmutable::add' => ['hasSideEffects' => false],
	'DateTimeImmutable::modify' => ['hasSideEffects' => false],
	'DateTimeImmutable::setDate' => ['hasSideEffects' => false],
	'DateTimeImmutable::setISODate' => ['hasSideEffects' => false],
	'DateTimeImmutable::setTime' => ['hasSideEffects' => false],
	'DateTimeImmutable::setTimestamp' => ['hasSideEffects' => false],
	'DateTimeImmutable::setTimezone' => ['hasSideEffects' => false],
	'DateTimeImmutable::sub' => ['hasSideEffects' => false],
	'DateTimeImmutable::diff' => ['hasSideEffects' => false],
	'DateTimeImmutable::format' => ['hasSideEffects' => false],
	'DateTimeImmutable::getOffset' => ['hasSideEffects' => false],
	'DateTimeImmutable::getTimestamp' => ['hasSideEffects' => false],
	'DateTimeImmutable::getTimezone' => ['hasSideEffects' => false],

	'XmlReader::next' => ['hasSideEffects' => true],
	'XmlReader::read' => ['hasSideEffects' => true],
];
