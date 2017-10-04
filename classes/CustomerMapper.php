<?php

class CustomerMapper extends Mapper
{
    public function getCustomers() {
        $sql = "SELECT *
            from customers c";

        $stmt = $this->db->query($sql);
        $results = [];
        while($row = $stmt->fetch()) {
            $results[] = new CustomerEntity($row);
        }
        return $results;
    }
    /**
     * Get one customer by its ID
     *
     * @param int $customer_id The ID of the customer
     * @return customerEntity  The customer
     */
    public function getCustomerById($customer_id) {
        $sql = "SELECT *
            from customers c
            where c.id = :customer_id";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute(["customer_id" => $customer_id]);
        $data = $stmt->fetch();
        if($result && is_array($data)) {
            return new CustomerEntity($data);
        }
        return null;
    }
    public function save(CustomerEntity $customer) {
        $sql = "UPDATE customers SET
                first_name  = :first_name,
                last_name   = :last_name,
                phone       = :phone,
                email       = :email, 
                address     = :address,
                city        = :city,
                state       = :state
            WHERE id = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':first_name', $customer->getFirst_name());
        $stmt->bindParam(':last_name',  $customer->getLast_name());
        $stmt->bindParam(':phone',      $customer->getPhone());
        $stmt->bindParam(':email',      $customer->getEmail());
        $stmt->bindParam(':address',    $customer->getAddress());
        $stmt->bindParam(':city',       $customer->getCity());
        $stmt->bindParam(':state',      $customer->getState());
        $stmt->bindParam(':id',         $customer->getId());

        $result = $stmt->execute();

        if(!$result) {
            throw new Exception("could not save record");
        }
    }
}