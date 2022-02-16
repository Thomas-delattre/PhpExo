<?php 
declare(strict_types = 1);



class Customer {
  private int $id;
  private string $firstname;
  private string $lastname;
  private string $email;

  public function __construct(
    string $p_firstname, 
    string $p_lastname,
    string $p_email
    )
    {
      $this->firstname = ucfirst(strtolower($p_firstname));
      $this->lastname = ucfirst(strtolower($p_lastname));
      $this->email = $p_email;
    }
    public function getId(): int
	{
		return $this->id;
	}
	
	public function setId(int $value): void
	{
		$this->id = $value;
	}
    public function getFirstname(): string
    {
        return ucfirst(strtolower($this->firstname));
    }
    public function getLastname(): string
    {
        return ucfirst(strtolower($this->lastname));
    }
    public function getEmail(): string
    {
        return $this->email;
    }
	
	public function insert(): ?int
	{
		$conn = connect_to_mysql();
		
		$query = $conn->prepare('INSERT INTO customers (firstname, lastname, email) 
		          VALUES (:firstname, :lastname, :email);');
		$result = $query->execute([
			':firstname' => $this->firstname,
			':lastname'  => $this->lastname,
			':email'     => $this->email, 
			]);
		if($result) {
			$this->id = (int)$conn->lastInsertId();
			return $this->id;
		} else {
			return null;
		}
	}

  }
