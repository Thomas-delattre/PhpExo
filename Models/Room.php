<?php 

declare(strict_types = 1);

class Room {
	private int $id;
    private string $name;
    private string $description;
    private int $duration;
    private bool $forbidden18yearOld;
    private string $niveau;
	private int $min_player;
	private int $max_player;
	private int $age;
	private string $img_css;
	private bool $new;

    public function __construct(
        string $p_name, 
        string $p_description,
        int $p_duration = 60,
        bool $p_18yo = false,
        string $p_niveau = "Normal",
		int $p_min_player = 2,
		int $p_max_player = 12,
		int $p_age = 16,
		string $p_img_css = 'roomCard2Img',
		bool $p_new = false)
    {
        $this->name = ucfirst(strtolower($p_name));
        $this->description = $p_description;
        $this->duration = $p_duration;
        $this->forbidden18yearOld = $p_18yo;
        $this->niveau = $p_niveau;
		$this->min_player = $p_min_player;
		$this->max_player = $p_max_player;
		$this->age = $p_age;
		$this->img_css = $p_img_css;
		$this->new = $p_new;
    }
    
    public function getName(): string
    {
        return ucfirst(strtolower($this->name));
    }
	public function getDescription(): string
	{
		return $this->description;
	}
	
	public function getNiveau() : string
	{
		return $this->niveau;
	}
	
	public function getDuration(): int
	{
		return $this->duration;
	}
	
	public function getMinPlayer(): int 
	{
		return $this->min_player;
	}
	
	public function getMaxPlayer(): int 
	{
		return $this->max_player;
	}
	
	public function getAge(): int
	{
		return $this->age;
	}
	
	public function getImgCss(): string
	{
		return $this->img_css;
	}
	
    public function setName(string $value)
    {
        $this->name = ucfirst(strtolower($value));
    }
    
    public function setOpen(string $value)
    {
        $this->open = $value;
    }
    
    public function setNiveau(string $value)
    {

        if($value == 'Difficile' ||
            $value == 'Normal' ||
            $value == 'Facile') {
            $this->niveau = htmlentities($value);
        } else {
            throw new Exception('Niveau inconnu');
        }
    }
    
    
    public function __toString()
    {
        return json_encode($this->toArray());
    }
	
	public function toArray()
	{
		return [
			'name' 				 => $this->name,
			'description' 		 => $this->description,
			'duration' 			 => $this->duration,
			'forbidden18yearOld' => $this->forbidden18yearOld,
			'niveau' 			 => $this->niveau,
			'min_player'		 => $this->min_player,
			'max_player' 		 => $this->max_player,
			'age'				 => $this->age,
			'img_css'		 	 => $this->img_css,
			'new'				 => $this->new,
		];
	}
	
	public function insert()
	{
		$sql = "INSERT INTO `rooms` (`name`, `description`, `duration`, `forbidden18yearOld`, `niveau`, `min_player`, `max_player`) 
                 VALUES             ('" . $this->name . "', 'sddfsdf', '60',          '0',              'Normal',       '2',       '12');";
		
		echo $sql;
	}
    
}
