<?php
/**
 * User Controller
 *
 * @author Serhii Shkrabak
 * @global object $CORE->model
 * @package Model\Main
 */
namespace Model;
class Main
{
	use \Library\Shared;

	public function formsubmitAmbassador(array $data):?array {
		// Тут модель повинна бути допрацьована, щоб використовувати бази даних, тощо
		
		$key = ''; // Ключ API телеграм
		if (!$key)
			throw new \Exception('No API key. Failed to send message');

 		$result = null;
		$chat = ;
		$firstname = $data['firstname'];
		$secondname = $data['secondname'];
		$phone = $data['phone'];
		$email = $data['email'];

		$text = "Нова заявка в *Цифрові Амбасадори*:\nІм'я: $firstname\nПрізвище: $secondname\n";
		if (!empty($data['position']))
			$text .= 'Посада: ' . $data['position'] . "\n"; 

		$text .= "\n*Зв'язок*: " . $phone . "\n" . 'Електронна пошта: ' . $email;
		$text = urlencode($text);
		$answer = file_get_contents("https://api.telegram.org/bot$key/sendMessage?parse_mode=markdown&chat_id=$chat&text=$text");
		$answer = json_decode($answer, true);
		$result = ['message' => $answer['result']];
		return $result;
	}

	public function __construct() {

	}
}