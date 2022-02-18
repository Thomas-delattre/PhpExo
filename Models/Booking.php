<?php

declare(strict_types=1);



class Booking
{
  private int $room_id;
  private int $customer_id;
  private int $schedule_id;
  private string $date;
  private int $nb_player;
  private int $total_price;

  public function __construct(
    int $p_room_id,
    int $p_customer_id,
    int $p_schedule_id,
    string $p_date,
    int $p_nb_player,
    int $p_total_price
  ) {
    $this->room_id = $p_room_id;
    $this->customer_id = $p_customer_id;
    $this->schedule_id = $p_schedule_id;
    $this->date = $p_date;
    $this->nb_player = $p_nb_player;
    $this->total_price = $p_total_price;
  }

  public function insert(): bool
  {
    $conn = connect_to_mysql();

    $query = $conn->prepare('INSERT INTO `booking` (`room_id`, `customer_id`, `schedule_id`, `date`, `nb_player`, `total_price`) 
								VALUES (:room_id, :customer_id, :schedule_id, :date, :nb_player, :total_price);');
    $result = $query->execute([
      ':room_id'     => $this->room_id,
      ':customer_id'  => $this->customer_id,
      ':schedule_id'  => $this->schedule_id,
      ':date'      => $this->date,
      ':nb_player'   => $this->nb_player,
      ':total_price'  => $this->total_price,
    ]);



    return $result;
  }
  public function getRoomId()
  {
    return $this->room_id;
  }
  public function getCustomerId()
  {
    return $this->customer_id;
  }
  public function getScheduleId()
  {
    return $this->schedule_id;
  }
  public function getDateById()
  {
    return $this->date;
  }
  public function getNbPlayersId()
  {
    return $this->nb_player;
  }
  public function getTotalPrice()
  {
    return $this->total_price;
  }
  public function updateBooking(): bool
  {
    $conn = connect_to_mysql();

    $query = $conn->prepare(
      "UPDATE `booking`
        SET room ='',
		customer ='', 
		schedule='',
		date = '',
		nb_player = '',
		total_price = ''
		WHERE id = :id"
    );


    $result = $query->execute([
      ':room_id'     => $this->room_id,
      ':customer_id'  => $this->customer_id,
      ':schedule_id'  => $this->schedule_id,
      ':date'      => $this->date,
      ':nb_player'   => $this->nb_player,
      ':total_price'  => $this->total_price,
    ]);
    return $result;
  }
  public function setRoomId(string $room_id)
  {
    $this->room_id = $room_id;
  }
  public function setCustomerId(string $customer_id)
  {
    $this->customer_id = $customer_id;
  }
  public function setScheduleId(string $schedule_id)
  {
    $this->schedule_id = $schedule_id;
  }
  public function setDateById(string $date)
  {
    $this->date = $date;
  }
  public function setNbPlayersId(string $nb_player)
  {
    $this->nb_player = $nb_player;
  }
  public function setTotalPrice(string $total_price)
  {
    $this->total_price = $total_price;
  }
}
