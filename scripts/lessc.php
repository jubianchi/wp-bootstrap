#!/usr/bin/env php
<?php
$output = realpath(__DIR__ . '/../css');
$main   = 'wp-bootstrap';
$files  = glob(realpath(__DIR__ . '/../css/less') . '/*.less');

$filelist = array();
foreach($files as $file) {
    $filename   = basename($file);
    $filelist[] = basename($filename, '.less');

    printf("\033[33mSending %s%s\033[0m", $file, PHP_EOL);
    $cmd = 'scp ' . $file . ' jubianchi@192.168.0.15:/tmp/' . $filename;
    printf("\033[36m==> %s%s\033[0m", $cmd, PHP_EOL);

    print "\033[31m";
    passthru($cmd);
    print "\033[0m";
}

printf("\033[33mCompiling %s.less%s\033[0m", $main, PHP_EOL);
$cmd = sprintf(
    'ssh jubianchi@192.168.0.15 \'lessc /tmp/%s.less\' > %s/%s.css && rm -f /tmp/{%s}.less',
    $main,
    $output,
    $main,
    implode(',', $filelist)
);
printf("\033[36m==> %s%s\033[0m", $cmd, PHP_EOL);

print "\033[31m";
passthru($cmd);
print "\033[0m";

printf("\033[33mMinifying %s.css%s\033[0m", $main, PHP_EOL);
$cmd = sprintf('java -jar %s/yui-compressor.jar -v %s/%s.css -o %s/%s.min.css && ls -lha %s', __DIR__, $output, $main, $output, $main, $output);
printf("\033[36m==> %s%s\033[0m", $cmd, PHP_EOL);

print "\033[31m";
passthru($cmd);
print "\033[0m";