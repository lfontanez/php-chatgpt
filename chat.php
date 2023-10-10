<?php
/*
 * PHP ChatGPT using OpenAI API by Leamsi Fontánez - lfontanez@r1software.com
 */
require_once( __DIR__ . '/vendor/autoload.php');

# Get $_ENV with dotenv
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

# Initialize OPEN AI PHP Client
$yourApiKey = $_ENV['OPEN_AI_KEY'];
$client = OpenAI::client($yourApiKey);

# Define Model and Limits
$model=$_ENV['DEFAULT_MODEL'];
$limit=intval($_ENV['CHAT_LIMIT']);
$max_tokens=intval($_ENV['MAX_TOKENS']);
$tts=boolval($_ENV['TTS_ENABLE']);
$tts_command=$_ENV['TTS_COMMAND'];

# Define messages
$messages = array();
$message = array();
$input='';
$i=0;

# Clear screen
echo "\e[H\e[J";

# Logo
echo"\e[0;36m
██████  ██   ██ ██████       ██████ ██   ██  █████  ████████  ██████  ██████  ████████ 
██   ██ ██   ██ ██   ██     ██      ██   ██ ██   ██    ██    ██       ██   ██    ██    
██████  ███████ ██████      ██      ███████ ███████    ██    ██   ███ ██████     ██    
██      ██   ██ ██          ██      ██   ██ ██   ██    ██    ██    ██ ██         ██    
██      ██   ██ ██           ██████ ██   ██ ██   ██    ██     ██████  ██         ██ \e[0m" . PHP_EOL;

# Heading Info
echo "\e[0;36mPHP ChatGPT DEMO v1.0 \e[0m" .PHP_EOL;
echo "\e[0;33mModel {$model}" . PHP_EOL;
echo "Limited to {$limit} replies" . PHP_EOL;
echo "Context Memory: ephemeral" . PHP_EOL;
echo "{$max_tokens} tokens" . PHP_EOL;
if ($tts) echo "TTS enabled: {$_ENV["TTS_ENABLE"]}\e[0m" . PHP_EOL . PHP_EOL;

	# Chat Loop
	while ($input != 'bye' && $i < $limit) {

		echo "[You] ";

		# Get user input
		$input = rtrim(fgets(STDIN));

		echo PHP_EOL;

		# Construct Payload
		$message["role"] = "user";
		$message["content"] = $input;
		$messages[] = $message;

		if ($input != 'bye') {
			# Define data
			$data = array();
			$data["model"] = $model;
			$data["messages"] = $messages;
			$data["max_tokens"] = $max_tokens;

			$last_response = $client->chat()->create($data);
			
			$responses[] = $last_response;

			# Current Response
			$say = $last_response["choices"][0]["message"]["content"];
			$messages[] = $last_response["choices"][0]["message"];
			echo "\e[0;37m[OPEN AI] "  . $say . PHP_EOL;
			echo "\e[0m" . PHP_EOL;

			# TTS Utterance
			if ($tts) {
				$command = "$tts_command $say";
			 	exec(escapeshellcmd($command));
			}
		}
	$i++;
	} //End While

# Session finished	
$say = "Goodbye.";
echo "\e[0;37m[OPEN AI] {$say}\e[0m"  . PHP_EOL;

# TTS Utterance
if ($tts) {
	$command = "say $say";
	exec(escapeshellcmd($command));
}

echo "\e[0;36mChat ended.\e[0m". PHP_EOL;