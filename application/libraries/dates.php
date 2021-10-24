<?php
class Dates
{ 
	/**
    * Convierte una fecha a formato sql estandar
    * @param $date Fecha a convertir
    * @param $default Fecha a devolver en caso de no poder convertir correctamente
    * @return string
    */
	public static function DMYtoYMD($date, $default = false) {
		if (preg_match("/([0-9]{1,2}).([0-9]{1,2}).([0-9]{4})/", $date, $regs)) { 
			return $regs[3].'/'.$regs[2].'/'.$regs[1];
		}
		if ($default !== false) {
			return $default;
		}
		return "0000/00/00";
	}

	/**
    * Convierte una fecha hora a formato sql estandar
    * @param $date Fecha a convertir
    * @param $default Fecha a devolver en caso de no poder convertir correctamente
    * @return string
    */
	public static function DMYtoYMDFull($date, $default = false) {
		if (preg_match("/([0-9]{1,2}).([0-9]{1,2}).([0-9]{4}).([0-9]{1,2}).([0-9]{1,2})/", $date, $regs)) { 
			return $regs[3].'/'.$regs[2].'/'.$regs[1].' '.$regs[4].':'.$regs[5];
		}
		if ($default !== false) {
			return $default;
		}
		return "0000/00/00";
	}
	/**
    * Convierte una fecha de formato sql estandar a fecha regional
    * @param $date Fecha a convertir
    * @param $default Fecha a devolver en caso de no poder convertir correctamente
    * @return string
    */
	public static function YMDtoDMY($date, $default = false) {
		if (preg_match("/([0-9]{4}).([0-9]{1,2}).([0-9]{1,2})/", $date, $regs)) { 
			return $regs[3].'/'.$regs[2].'/'.$regs[1];
		}
		if ($default !== false) {
			return $default;
		}
		return "00/00/0000";
	}
	
	/**
    * Convierte una fecha de formato sql estandar a fecha hora regional
    * @param $date Fecha a convertir
    * @param $default Fecha a devolver en caso de no poder convertir correctamente
    * @return string
    */
	public static function YMDtoDMYFull($date, $default = false) {
		if (preg_match("/([0-9]{4}).([0-9]{1,2}).([0-9]{1,2}).([0-9]{1,2}).([0-9]{1,2}).([0-9]{1,2})/", $date, $regs)) { 
			return $regs[3].'/'.$regs[2].'/'.$regs[1].' '.$regs[4].':'.$regs[5];
		}
		if ($default !== false) {
			return $default;
		}
		return "00/00/0000";
	}
	
	
	
	public static function is_valid_YMD($date)
	{
		$out = self::YMDtoDMY($date, 'invalid');
		
		return ($out != 'invalid');
	}
	
	public static function is_valid_DMY($date)
	{
		$out = self::DMYtoYMD($date, 'invalid');

		return ($out != 'invalid');
	}

    public static function sinceYMDFull($date)
    {
		$dateTime = new DateTime($date);
        return new DateTimeDecorator($dateTime);
    }
	
}

class DateTimeDecorator
{
    private $_dateTime;

    public function __construct(DateTime $dateTime)
    {
        $this->_dateTime = $dateTime;
    }

    protected $strings = Array (
        'y' => array( 'Hace un año', 'Hace %d años' ),
        'm' => array( 'Hace un mes', 'Hace %d meses' ),
        'd' => array( 'Hace un día', 'Hace %d días' ),
        'h' => array( 'Hace una hora', 'Hace %d horas' ),
        'i' => array( 'Hace un minuto', 'Hace %d minutos' ),
        's' => array( 'Hace un segundo', 'Hace %d segundos' ),
    );

    /**
     * Returns the difference from the current time in the format X time ago
     * @return string
     */
    public function __toString()
    {
        $now = new DateTime;
        $diff = $this->_dateTime->diff($now);

        foreach ( $this->strings as $key => $value ) {
            if ( ($text = $this->getDiffText($key, $diff) ) ) {
                return $text;
            }
        }

        return 'Hace un segundo';
    }

    /**
     * Try to construct the time diff text with the specified interval key
     * @param string $intervalKey A value of: [y,m,d,h,i,s]
     * @param DateInterval $diff
     * @return string|null
     */
    protected function getDiffText($intervalKey, $diff)
    {
        $pluralKey = 1;
        $value = $diff->$intervalKey;

        if ( $value > 0 ) {
            if ( $value < 2 ) {
                $pluralKey = 0;
            }

            return sprintf($this->strings[$intervalKey][$pluralKey], $value);
        }

        return null;
    }


}
