<?php

declare(strict_types=1);

class Schedule
{

	private int $id;
	private string $heure;

	public function __construct(int $p_id, string $p_heure)
	{
		$this->id = $p_id;
		$this->heure = $p_heure;
	}

	public function getId()
	{
		return $this->id;
	}

	public function getHeure()
	{
		$new_time = DateTime::createFromFormat('H:i:s', $this->heure);
		return $new_time->format('H\hi');
	}
}
