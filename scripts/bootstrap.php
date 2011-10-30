<?php
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

if(PHP_SAPI !== 'cli') exit(1);

const VERSION = '0.1';
const AUTHOR  = 'jubianchi <contact@jubianchi.fr>';

$root = '';
spl_autoload_register(function($class) use($root) {
	$root = $root != '' ? $root . DIRECTORY_SEPARATOR : $root;
	$class = ltrim(
		sprintf('%s.php', str_replace('\\', DIRECTORY_SEPARATOR, $class)), 
		DIRECTORY_SEPARATOR
	);	
	
	require_once $root . $class;
});

function call(Symfony\Component\Console\Application $console, $command, Symfony\Component\Console\Input\InputInterface $input, Symfony\Component\Console\Output\OutputInterface $output) {
	return $console -> find($command) -> run($input, $output);
}

function dirsize($dir) {
	$size = 0; 
	$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir, FilesystemIterator::SKIP_DOTS));
	
    foreach($iterator as $file){ 
        $size += $file -> getSize(); 
    } 
    return $size; 
}

$console = new Application('wp-bootstrap', VERSION);

$console 
	-> register('info')
	-> setDescription('Display informations')
	-> setCode(function (InputInterface $input, OutputInterface $output) use($console) {
		static $ran = false;		
		
		if(!$ran) {
			$output -> writeln(sprintf('> <info>wp-bootstrap</info> version <comment>%s</comment> by %s', VERSION, AUTHOR));
			$output -> writeln(sprintf('> <info>PHP</info> version <comment>%s %s</comment>', phpversion(), php_sapi_name()));
			$output -> writeLn(sprintf('> <info>%s</info>', php_uname()));	
			$output -> writeLn('<question>-----------------------------------------------------------</question>');
			
			$ran = true;
		}
	});

$console 
	-> register('build')
	-> setDefinition(array(
		new InputOption('output', null, InputOption::VALUE_REQUIRED, 'Output path', __DIR__ . '/../build'),			
		new InputOption('clean', null, InputOption::VALUE_NONE, 'Clean before build'),
		new InputOption('no-combine', null, InputOption::VALUE_NONE, 'Combine CSS'),
		
		new InputOption('no-css', null, InputOption::VALUE_NONE, 'Build CSS'),
		new InputOption('no-combine-css', null, InputOption::VALUE_NONE, 'Combine CSS'),
		
		new InputOption('no-js', null, InputOption::VALUE_NONE, 'Build JS'),
		new InputOption('no-combine-js', null, InputOption::VALUE_NONE, 'Combine JS')	
	))
	-> setDescription('Build the theme')
	-> setHelp(<<<HELP
HELP
	)
	-> setCode(function (InputInterface $input, OutputInterface $output) use($console) {		
		call($console, 'info', new ArrayInput(array('command' => 'build')), $output);
		
		$output -> writeLn(sprintf('> <info>Starting</info> <comment>build%s</comment> <info>script</info>', $input -> getOption('clean') ? ' & clean' : ''));	
		
		if(!is_dir($input -> getOption('output'))) mkdir($input -> getOption('output'));	
		
		$args = array(				
			'command'      => 'build',
			'--output'     => $input->getOption('output')			
		);
		if($input -> getOption('clean')) $args['--clean'] = null;
				
		if(!$input -> getOption('no-css')) {
			if($input -> getOption('no-combine') || $input -> getOption('no-combine-css')) {
				$args['--no-combine'] = true;
			}
			call($console, 'css:build', new ArrayInput($args), $output);
			unset($args['--no-combine']);
		}
		if(!$input -> getOption('no-js')) {
			if($input -> getOption('no-combine') || $input -> getOption('no-combine-js')) {
				$args['--no-combine'] = true;
			}
			call($console, 'js:build',  new ArrayInput($args), $output);
			unset($args['--no-combine']);
		}
		
		if($input -> getOption('clean')) {
			$output -> writeLn(sprintf('>>> <info>Cleaning</info> <comment>PHP</comment> <info>in</info> <comment>%s</comment>', $input -> getOption('output')));
			try {
				$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($input -> getOption('output'), FilesystemIterator::SKIP_DOTS));					

				foreach($iterator as $path => $file) {										
					if(!in_array(basename($path), array('css', 'js')) !== false) {
						if(is_file($path)) unlink($path);
					}
				}
			} catch(Exception $e) {
				$output -> writeLn('>>> <info>Nothing to clean here</info>');

				if(!is_dir($input -> getOption('output'))) mkdir($input -> getOption('output'));
			}
		}

		$basedir = realpath(__DIR__ . DIRECTORY_SEPARATOR . '..');
		$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($basedir, FilesystemIterator::SKIP_DOTS));							
		
		foreach($iterator as $path => $file) {																			
			$include =  array(
				$basedir,
				$basedir . DIRECTORY_SEPARATOR . 'admin',
				$basedir . DIRECTORY_SEPARATOR . 'fonts',
				$basedir . DIRECTORY_SEPARATOR . 'img',
				$basedir . DIRECTORY_SEPARATOR . 'inc',				
				$basedir . DIRECTORY_SEPARATOR . 'languages',				
			);
			
			if(in_array(dirname($path), $include)) {
				$dest = str_replace($basedir, $input -> getOption('output'), $path);			
				if(!is_dir(dirname($dest))) {									
					$output -> writeLn(sprintf('>>> <info>Creating directory</info> <comment>%s</comment>', dirname($dest)));
					mkdir(dirname($dest), 0777, true);
				}

				copy($path, $dest);
			}
		}
	});	

	
$console 
	-> register('css:clean')
	-> setDefinition(array(					
		new InputOption('output', null, InputOption::VALUE_REQUIRED, 'Output path', __DIR__ . '/../build')
	))
	-> setDescription('Clean the build directory')
	-> setHelp(<<<HELP
HELP
	)
	-> setCode(function (InputInterface $input, OutputInterface $output) use($console) {
		call($console, 'info', new ArrayInput(array('command' => 'css:clean')), $output);
		
		$output -> writeLn('> <info>Starting</info> <comment>css:clean</comment> <info>script</info>');	
		
		$cssdir = $input->getOption('output') . DIRECTORY_SEPARATOR . 'css';
		$output -> writeLn(sprintf('>>> <info>Cleaning</info> <comment>CSS</comment> <info>in</info> <comment>%s</comment>', $cssdir));	

		try {
			$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($cssdir, FilesystemIterator::SKIP_DOTS));					

			foreach($iterator as $path => $file) {										
				if(is_file($path)) unlink($path);
			}
		} catch(Exception $e) {
			$output -> writeLn('>>> <info>Nothing to clean here</info>');

			if(!is_dir($cssdir)) mkdir($cssdir);
		}
			
		$output -> writeLn('<question>-----------------------------------------------------------</question>');
	});
	
$console 
	-> register('css:build')
	-> setDefinition(array(
		new InputOption('output', null, InputOption::VALUE_REQUIRED, 'Output path', __DIR__ . '/../build'),
		new InputOption('clean', null, InputOption::VALUE_NONE, 'Clean before build'),
		new InputOption('no-combine', null, InputOption::VALUE_NONE, 'Combine CSS')
	))
	-> setDescription('Build the theme')
	-> setHelp(<<<HELP
HELP
	)
	-> setCode(function (InputInterface $input, OutputInterface $output) use($console) {
		call($console, 'info', new ArrayInput(array('command' => 'css:build')), $output);
		
		$output -> writeLn(sprintf(
			'> <info>Starting</info> <comment>%scss:build%s</comment> <info>script</info>', 
			$input->getOption('clean') ? 'css:clean & ' : '',  
			$input->getOption('no-combine') ? ' & css:combine' : ''
		));

		if($input->getOption('clean')) {
			call($console, 'css:clean', new ArrayInput(array('command' => 'css:build')), $output);
		}
		
		$cssdir['dest']   = realpath($input->getOption('output') . DIRECTORY_SEPARATOR . 'css');
		$cssdir['source'] = realpath(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'css');		
		
		$output -> writeLn(sprintf('>>> <info>Using source directory</info> <comment>%s</comment>', $cssdir['source']));
		$output -> writeLn(sprintf('>>> <info>Using output directory</info> <comment>%s</comment>', $cssdir['dest']));

		if(!is_dir($cssdir['dest'])) mkdir($cssdir['dest']);			
		$iterator = new IteratorIterator(new RecursiveDirectoryIterator($cssdir['source'], FilesystemIterator::SKIP_DOTS));					

		foreach($iterator as $path => $file) {										
			if(!is_file($path)) continue;
			
			$destpath = $cssdir['dest'] . DIRECTORY_SEPARATOR . basename($path);			
			$cmd = 'java -jar ' . __DIR__ . DIRECTORY_SEPARATOR . 'yui-compressor.jar ' . $path . ' > ' . $destpath;
			
			$output -> writeLn(sprintf('>>> <info>Minifying</info> <comment>js/%s</comment>', basename($path)));
			exec($cmd);
		}		
		
		$size['source'] = dirsize($cssdir['source']);
		$size['dest'] = dirsize($cssdir['dest']);
		$output -> writeLn(sprintf('>>> <info>Directory size before</info> <comment>%.2f Ko</comment>', $size['source'] / 1024));
		$output -> writeLn(sprintf('>>> <info>Directory size after</info> <comment>%.2f Ko</comment>', $size['dest'] / 1024));
		$output -> writeLn(sprintf('>>> <info>CSS Compression</info> <question> %.2f%% </question>', (1 - ($size['dest'] / $size['source'])) * 100));
		$output -> writeLn('<question>-----------------------------------------------------------</question>');
		
		if(!$input->getOption('no-combine')) {
			call($console, 'css:combine', new ArrayInput(array('command' => 'css:build')), $output);
		}			
	});	
	
$console 
	-> register('css:combine')
	-> setDefinition(array(
		new InputOption('output', null, InputOption::VALUE_REQUIRED, 'Output path', __DIR__ . '/../build'),
		new InputOption('clean', null, InputOption::VALUE_NONE, 'Clean before build')
	))
	-> setDescription('Build the theme')
	-> setHelp(<<<HELP
HELP
	)
	-> setCode(function (InputInterface $input, OutputInterface $output) use($console) {
		call($console, 'info', new ArrayInput(array('command' => 'css:combine')), $output);
		
		$output -> writeLn(sprintf('> <info>Starting</info> <comment>css:combine</comment> <info>script</info>'));	
		
		$cssdir  = realpath($input->getOption('output') . DIRECTORY_SEPARATOR . 'css');
		$combine = array(
			'bootstrap.css',
			'facebox.css',
			'prettify.css',
			'style.css'
		);
		$css = '';
		foreach($combine as $file) {
			$output -> writeLn(sprintf('>>> <info>Combining</info> <comment>css/%s</comment>', $file));
			$css .= file_get_contents($cssdir . DIRECTORY_SEPARATOR . $file);
			if(is_file($cssdir . DIRECTORY_SEPARATOR . $file)) unlink($cssdir . DIRECTORY_SEPARATOR . $file);
		}	
		$fp = fopen($cssdir . DIRECTORY_SEPARATOR . 'wpbootstrap.css', 'w+');
		fwrite($fp, $css);
		fclose($fp);

		
		$output -> writeLn('<question>-----------------------------------------------------------</question>');
	});	

$console 
	-> register('js:clean')
	-> setDefinition(array(					
		new InputOption('output', null, InputOption::VALUE_REQUIRED, 'Output path', __DIR__ . '/../build')
	))
	-> setDescription('Clean the build directory')
	-> setHelp(<<<HELP
HELP
	)
	-> setCode(function (InputInterface $input, OutputInterface $output) use($console) {
		call($console, 'info', new ArrayInput(array('command' => 'js:clean')), $output);
		
		$output -> writeLn('> <info>Starting</info> <comment>js:clean</comment> <info>script</info>');	
		
		$jsdir = $input->getOption('output') . DIRECTORY_SEPARATOR . 'js';
		$output -> writeLn(sprintf('>>> <info>Cleaning</info> <comment>JS</comment> <info>in</info> <comment>%s</comment>', $jsdir));	

		try {
			$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($jsdir, FilesystemIterator::SKIP_DOTS));					

			foreach($iterator as $path => $file) {										
				if(is_file($path)) unlink($path);
			}
		} catch(Exception $e) {
			$output -> writeLn('>>> <info>Nothing to clean here</info>');

			if(!is_dir($jsdir)) mkdir($jsdir);
		}
		
		$output -> writeLn('<question>-----------------------------------------------------------</question>');
	});
	
$console 
	-> register('js:build')
	-> setDefinition(array(
		new InputOption('output', null, InputOption::VALUE_REQUIRED, 'Output path', __DIR__ . '/../build'),
		new InputOption('clean', null, InputOption::VALUE_NONE, 'Clean before build'),
		new InputOption('no-combine', null, InputOption::VALUE_NONE, 'Combine CSS')
	))
	-> setDescription('Build the theme')
	-> setHelp(<<<HELP
HELP
	)
	-> setCode(function (InputInterface $input, OutputInterface $output) use($console) {
		$console->find('info')->run(new ArrayInput(array('command' => 'jsmin')), $output);
		
		$output -> writeLn(sprintf(
			'> <info>Starting</info> <comment>%sjs:build</comment> <info>script</info>', 
			$input->getOption('clean') ? 'js:clean & ' : '', 
			$input->getOption('no-combine') ? ' & css:combine' : ''
		));

		if($input->getOption('clean')) {
			call($console, 'js:clean', new ArrayInput(array('command' => 'js:build')), $output);
		}
		
		$jsdir['dest']   = $input->getOption('output') . DIRECTORY_SEPARATOR . 'js';
		$jsdir['source'] = realpath($input->getOption('output') . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'js');
		$output -> writeLn(sprintf('>>> <info>Using source directory</info> <comment>%s</comment>', $jsdir['source']));
		$output -> writeLn(sprintf('>>> <info>Using output directory</info> <comment>%s</comment>', $jsdir['dest']));

		if(!is_dir($jsdir['dest'])) mkdir($jsdir['dest']);			
		$iterator = new IteratorIterator(new RecursiveDirectoryIterator($jsdir['source'], FilesystemIterator::SKIP_DOTS));					

		foreach($iterator as $path => $file) {										
			if(!is_file($path)) continue;
			
			$destpath = $jsdir['dest'] . DIRECTORY_SEPARATOR . basename($path);			
			$cmd = 'java -jar ' . __DIR__ . DIRECTORY_SEPARATOR . 'closure-compiler.jar --warning_level QUIET --js ' . $path . ' --js_output_file ' . $destpath;
			
			$output -> writeLn(sprintf('>>> <info>Minifying</info> <comment>js/%s</comment>', basename($path)));
			exec($cmd);
		}	
		
		$size['source'] = dirsize($jsdir['source']);
		$size['dest'] = dirsize($jsdir['dest']);
		$output -> writeLn(sprintf('>>> <info>Directory size before</info> <comment>%.2f Ko</comment>', $size['source'] / 1024));
		$output -> writeLn(sprintf('>>> <info>Directory size after</info> <comment>%.2f Ko</comment>', $size['dest'] / 1024));
		$output -> writeLn(sprintf('>>> <info>JS Compression</info> <question> %.2f%% </question>', (1 - ($size['dest'] / $size['source'])) * 100));
		
		$output -> writeLn('<question>-----------------------------------------------------------</question>');
		
		if(!$input->getOption('no-combine')) {
			call($console, 'js:combine', new ArrayInput(array('command' => 'js:build')), $output);
		}		
	});	
	
$console 
	-> register('js:combine')
	-> setDefinition(array(
		new InputOption('output', null, InputOption::VALUE_REQUIRED, 'Output path', __DIR__ . '/../build'),
		new InputOption('clean', null, InputOption::VALUE_NONE, 'Clean before build')
	))
	-> setDescription('Build the theme')
	-> setHelp(<<<HELP
HELP
	)
	-> setCode(function (InputInterface $input, OutputInterface $output) use($console) {
		call($console, 'info', new ArrayInput(array('command' => 'js:combine')), $output);
		
		$output -> writeLn(sprintf('> <info>Starting</info> <comment>js:combine</comment> <info>script</info>'));	
		
		$jsdir  = realpath($input->getOption('output') . DIRECTORY_SEPARATOR . 'js');
		$combine = array(
			'bootstrap-twipsy.js',
			'bootstrap-scrollspy.js',
			'bootstrap-alerts.js',
			'bootstrap-dropdown.js',
			'bootstrap-modal.js',
			'bootstrap-popover.js',			
			'bootstrap-tabs.js',
			'dotdotdot.js',
			'facebox.js',
			'prettify.js'			
			
		);
		$js = '';
		foreach($combine as $file) {
			$output -> writeLn(sprintf('>>> <info>Combining</info> <comment>js/%s</comment>', $file));
			$js .= file_get_contents($jsdir . DIRECTORY_SEPARATOR . $file);
			if(is_file($jsdir . DIRECTORY_SEPARATOR . $file)) unlink($jsdir . DIRECTORY_SEPARATOR . $file);			
		}			
		$fp = fopen($jsdir . DIRECTORY_SEPARATOR . 'wpbootstrap.js', 'w+');
		fwrite($fp, $js);
		fclose($fp);
		
		$output -> writeLn('<question>-----------------------------------------------------------</question>');
	});
return $console -> run();
__HALT_COMPILER();