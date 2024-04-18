<?php

class Appointment {
    private $date;
    private $time;
    private $doctor;
    private $patient;

    public function __construct($date, $time, $doctor) {
        $this->date = $date;
        $this->time = $time;
        $this->doctor = $doctor;
        $this->patient = null;
    }

    public function scheduleAppointment($patient) {
        if ($this->patient === null) {
            $this->patient = $patient;
            echo "Appointment scheduled for {$this->date} at {$this->time} with {$this->doctor} for patient {$this->patient->getName()}.\n";
        } else {
            echo "Appointment already scheduled for {$this->date} at {$this->time} with {$this->doctor}.\n";
        }
    }

    public function cancelAppointment() {
        if ($this->patient !== null) {
            echo "Appointment canceled for {$this->date} at {$this->time} with {$this->doctor}.\n";
            $this->patient = null;
        } else {
            echo "No appointment scheduled for {$this->date} at {$this->time} with {$this->doctor}.\n";
        }
    }
}

class Patient {
    private $name;
    private $id;

    public function __construct($name, $id) {
        $this->name = $name;
        $this->id = $id;
    }

    public function bookAppointment($appointment) {
        $appointment->scheduleAppointment($this);
    }

    public function cancelAppointment($appointment) {
        echo "Appointment canceled for patient {$this->name}.\n";
        $appointment->cancelAppointment();
    }

    public function getName() {
        return $this->name;
    }
}

class Scheduler {
    private $appointments = [];

    public function checkAvailability($date) {
        foreach ($this->appointments as $appointment) {
            if ($appointment->getDate() === $date) {
                return false; 
            }
        }
        return true; 
    }

    public function updateSchedule($appointment) {
        $this->appointments[] = $appointment;
        echo "Schedule updated for {$appointment->getDate()}.\n";
    }
}


$patient1 = new Patient("John Doe", 1);
$patient2 = new Patient("Jane Smith", 2);

$appointment1 = new Appointment("2024-04-21", "10:00 AM", "Dr. Smith");
$appointment2 = new Appointment("2024-04-22", "11:00 AM", "Dr. Johnson");

$patient1->bookAppointment($appointment1);
$patient2->bookAppointment($appointment1);
$patient1->cancelAppointment($appointment1);
$patient2->bookAppointment($appointment2);

?>
