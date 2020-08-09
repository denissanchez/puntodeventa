<?php


namespace App\Utils;


use App\Utils\Interfaces\IReporte;

class Report
{
    private $type;
    private $startDate;
    private $endDate;

    public function __construct(IReporte $type)
    {
        $this->type = $type;
    }

    public function setRange($startDate, $endDate)
    {
        $this->startDate = ($this->getDateFormatted($startDate)).' 00:00:00';
        $this->endDate = ($this->getDateFormatted($endDate)).' 23:59:00';
    }

    public function getDateFormatted($date)
    {
        return date('Y-m-d', strtotime($date));
    }

    public function generate()
    {
        return $this->type->generate($this->startDate, $this->endDate);
    }
}
