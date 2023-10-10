# PHP ChatGPT DEMO v1.0 #

![Screenshot](https://github.com/lfontanez/php-chatgpt/raw/master/screenshot.png)

This project demonstrates ChatGPT using the [OpenAI](https://openai.com/) API in PHP. The code allows you to have interactive conversations with the ChatGPT model. If enabled, it can execute an available Text-to-Speech (TTS) command to audibly speak responses.

## Prerequisites

- PHP 8.1 installed on your system
- `composer` package manager installed
- For TTS you need a command like `say` in Linux/MacOS, [espeak](https://espeak.sourceforge.net/) (multi-platform alternative), or the native SAPI Speech Synthesis for Windows.

## Getting Started

1. Clone the repository or download the code files.

2. Install the required dependencies using `composer` by running the following command:

```
composer install
```
3. Rename the `.env.example` file to `.env` and update the environment variables with your OpenAI API key and other desired configurations.

4. Open the `chatgpt.php` file in your PHP IDE or text editor.

5. Run the PHP script in the command line:

```
php chatgpt.php
```
If `php` is not in your environment path you need to use the full path to your desired PHP binary. Example: `/usr/bin/php`

6. Start interacting with the ChatGPT model by entering your messages in the command line where prompted.

## Configuration

You can customize the behavior of the ChatGPT demo by modifying the environment variables in the .env file.

  - OPEN_AI_KEY: Your OpenAI API key.
  - DEFAULT_MODEL: The model to use for generating responses.
  - CHAT_LIMIT: The limit for the number of replies in the conversation.
  - MAX_TOKENS: The maximum number of tokens allowed in a response.
  - TTS_ENABLE: Enable or disable text-to-speech (TTS) functionality.
  - TTS_COMMAND: The command or script to use for TTS.

## Usage

The demo will display a logo and some information about the ChatGPT version and settings.

You can enter your messages in the command line. The demo will send your message to the ChatGPT model and display the generated response.

The conversation will continue until you enter "bye" or reach the defined limit of replies.

If TTS is enabled, the generated response will also be pronounced aloud.

The demo will end with a "Goodbye" message.

## Author

Leamsi Fontánez - lfontanez@r1software.com

## License

This project is licensed under the MIT License.

Please note that the provided README file assumes you have already set up the necessary environment variables and installed the required dependencies.