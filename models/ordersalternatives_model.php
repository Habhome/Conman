<?php
	class OrdersalternativesModel extends Model {  
		function getAlternatives()
		{
			return $this->db->query("SELECT orders_alternatives.*, COUNT(orders_values.id) AS ammount_compare
			FROM orders_alternatives
			LEFT OUTER JOIN orders_values ON orders_values.order_alternative_id = orders_alternatives.id
			LEFT OUTER JOIN orders ON orders.id = orders_values.order_id AND orders.status = 'COMPLETED'
			GROUP BY orders_alternatives.id;");
		}
	}
?>