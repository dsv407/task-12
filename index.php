<?php
$example_persons_array = [
    [
        'fullname' => 'Иванов Иван Иванович',
        'job' => 'tester',
    ],
    [
        'fullname' => 'Степанова Наталья Степановна',
        'job' => 'frontend-developer',
    ],
    [
        'fullname' => 'Пащенко Владимир Александрович',
        'job' => 'analyst',
    ],
    [
        'fullname' => 'Громов Александр Иванович',
        'job' => 'fullstack-developer',
    ],
    [
        'fullname' => 'Славин Семён Сергеевич',
        'job' => 'analyst',
    ],
    [
        'fullname' => 'Цой Владимир Антонович',
        'job' => 'frontend-developer',
    ],
    [
        'fullname' => 'Быстрая Юлия Сергеевна',
        'job' => 'PR-manager',
    ],
    [
        'fullname' => 'Шматко Антонина Сергеевна',
        'job' => 'HR-manager',
    ],
    [
        'fullname' => 'аль-Хорезми Мухаммад ибн-Муса',
        'job' => 'analyst',
    ],
    [
        'fullname' => 'Бардо Жаклин Фёдоровна',
        'job' => 'android-developer',
    ],
    [
        'fullname' => 'Шварцнегер Арнольд Густавович',
        'job' => 'babysitter',
    ],
];

function getFullnameFromParts($surname, $name, $patronomyc){
    $fullname = "";
    $fullname .= $surname;
    $fullname .= " ";
    $fullname .= $name;
    $fullname .= $patronomyc;
    return $fullname;
}

function getPartsFromFullname($fullname){
    $personName = explode(' ', $fullname)
    $fio = [
        'surname' => $personName[0],
        'name' => $personName[1],
        'patromomyc' => $personName[2],
    ];
    return $fio
}

function getShortName($fullname){
$shortName = "";
$shortName .= getPartsFromFullname($fullname)['name'];
$shortName .= " ";
$shortName .= mb_substr(getPartsFromFullname($fullname)['surname'], 0, 1);
$shortName .= ".";
return $surname
}

function getGenderFromName($personality){
    gender = 0;
    $fullname = getPartsFromFullname($personality);
	$searchName = mb_substr($fullname['name'], mb_strlen($fullname['name']) - 1);
	$searchSurnameFemale = mb_substr($fullname['surname'], mb_strlen($fullname['surname']) - 2);
	$searchSurnameMale = mb_substr($fullname['surname'], mb_strlen($fullname['surname']) - 1);
	$searchPatronomycFemale = mb_substr($fullname['patronomyc'], mb_strlen($fullname['patronomyc']) - 3);
	$searchPatronomycMale = mb_substr($fullname['patronomyc'], mb_strlen($fullname['patronomyc']) - 2);
	if (($searchName == 'й' || $searchName == 'н') || ($searchSurnameMale == 'в') || ($searchPatronomycMale == 'ич')) {
		$gender++;
	}elseif (($searchName == 'а') || ($searchSurnameFemale == 'ва') || ($searchPatronomycFemale == 'вна')) {
		$gender--;
	}
	if($gender > 0){
		$printGender = "мужской пол";
	}elseif ($gender < 0) {
		$printGender = "женский пол";
	}else {
		$printGender = "неопределенный пол";
	}
	return $printGender;
}

function getGenderDescription($array){
	for ($i=0; $i < count($array); $i++) { 
		$person = $array[$i]['fullname'];
		$gender[$i] = getGenderFromName($personality);
		};
	$numbersMale = array_filter($gender, function($gender) {
   	return $gender == "мужской пол";
   });
	$numbersFemale = array_filter($gender, function($gender) {
   	return $gender == "женский пол";
   });
	$numbersOther = array_filter($gender, function($gender) {
   	return $gender == "неопределенный пол";
	});
	$resultMale = count($numbersMale)/count($array) * 100;
	$resultFemale = count($numbersFemale)/count($array) * 100;
	$resultOth = count($numbersOther)/count($array) * 100;

	echo 'Гендерный состав аудитории: <hr>' . 'Мужчины - ' . round($resultMale, 2). '%<br>' . 'Женщины - ' . round($resultFemale, 2) . '%<br>' . 'Не удалось определить - ' . round($resultOth, 2) . '%<br>';
};