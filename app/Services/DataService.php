<?php

namespace App\Services;


class DataService
{
    public function setLocation(){
        $location =
        [
            'headquaters',
            'liason_offices'
        ];
        return $location;
    }

    public function getHeadquaters() {
        return [
            'Directorates',
            'Departments'
        ];
    }

    // public function setDepartments() {
    //     return [
    //         'Registry',
    //         'Audit',
    //         'Library and Information',
    //         'Consultancy',
    //         'Transport Reseach and Intelligence',
    //         'Transport School',
    //         'Transport Technology Center',
    //         'Bursary'
    //     ];
    // }

    public function getLiasons() {
        return [
            'abuja' => 'Abuja',
            'kano' => 'Kano',
            'lagos' => 'Lagos',
            'portharcourt' => 'Portharcourt',
            'gombe' => 'Gombe',
            'ebonyi' => 'Ebonyi',
            'katsina' => 'Katsina',
            'ekiti' => 'Ekiti'
        ];
    }

    public function getDirectorates() {
        return [
            'Legal' => 'Legal',
            'Servicom' => 'Servicom',
            'Annexes' => 'Annexes',
            'Procurements' => 'Procurements',
            'Physical Plannings' => 'Physical Plannings'
        ];
    }

    public function setUnit() {

        return [
            'Budget and Planning',
            'Final Account',
            'Revenue',
            'Asset Management',
            'Stores',
            'Personel Enrollment',
            'Loan and Advances',
            'Expenditure Control'
        ];
    }

    public function setRegistry() {
        return [
            'Personel',
            'Accademic',
            'Administrative',
            'Asset Management',
            'Student Affairs',
        ];
    }

    public function setAudit() {
        return [
            'Pre-Payment',
            'Post-Payment',
            'Store',
            'Asset Management',
            'Revenue',
        ];
    }

    public function setLibrary() {
        return [
            'Pre-Payment',
            'Post-Payment',
            'Store',
            'Asset Management',
            'Revenue',
        ];
    }

    public function setConsultancy() {
        return [];
    }
    public function setTransportResearch() {
        return [];
    }
    public function setTransportSchool() {
        return [];
    }
    public function setTransportTechnology() {
        return [];
    }
}
