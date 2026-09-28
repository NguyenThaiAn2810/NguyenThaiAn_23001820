<?php
class CartItem {
	public $name;
	public $price;
	public $quantity;

	public function __construct($name, $price, $quantity) {
		$this->name = $name;
		$this->price = $price;
		$this->quantity = $quantity;
	}
	public function getTotal() {
		return $this->price * $this->quantity;
	}
}
class ShoppingCart {
	private array $items;

	public function __construct() {
		$this->items = [];
	}
	public function addItem(CartItem $item) {
		// chỉ thêm sản phẩm có price và quantity > 0
		if ($item->price <= 0) {
            echo "Không thể thêm '{$item->name}': Đơn giá phải lớn hơn 0.\n";
        } elseif ($item->quantity <= 0) {
            echo "Không thể thêm '{$item->name}': Số lượng phải lớn hơn 0.\n";
        } else {
			$this->items[] = $item;
            echo "Đã thêm '{$item->name}' vào giỏ hàng.\n";
		}
	}
	public function removeItem($name) {
		$isFound = false; // Biến kiểm tra xem có tìm thấy sản phẩm không
        
		foreach($this->items as $key => $item) {
			if ($item->name === $name) {
				unset($this->items[$key]);
                $isFound = true;
                echo "Đã xoá sản phẩm '{$name}' khỏi giỏ hàng.\n";
                break; 
			}
		}

        // Thông báo không tìm thấy sản phẩm
        if (!$isFound) {
            echo "Sản phẩm '{$name}' không tồn tại trong giỏ hàng.\n";
        }

		// sắp xếp lại index sau khi xoá
		$this->items = array_values($this->items);
	}
	public function calculateTotal() {
		$total = 0;
		// nếu không có sản phẩm, trả về 0
		if (empty($this->items)) {
			return 0;
		}
		foreach($this->items as $item) {
			$total += $item->getTotal();
		}
		return $total;
	}
	public function displayCart() {
		echo "Shopping cart:", "\n";
		if (empty($this->items)) {
            echo "Giỏ hàng đang trống.\n";
        } else {
			foreach($this->items as $item) {
				echo "Item: Name: ". $item->name. 
					". Price: ". $item->price.
					".  Quantity: ". $item->quantity. 
					". Total item price: ". $item->getTotal()."\n";
			}
			echo "Total amount: ", $this->calculateTotal(), "\n";
		}
	}
}
// tạo 1 object ShoppingCart và 1 vài CartItem
$shoppingCart = new ShoppingCart();
$listItems = [
	$item1 = new CartItem("rice", 20, 5),
	$item2 = new CartItem("meat", 40, 7),
	$item3 = new CartItem("cake", 50, 10),
	$item4 = new CartItem("cabbage", 15, 20),
	$itemInvalidPrice = new CartItem("apple", 0, 5), // Lỗi giá <= 0
	$itemInvalidQty = new CartItem("banana", 10, -2) // Lỗi số lượng <= 0
];
// thêm hàng vào giỏ
echo "Thêm hàng vào giỏ:\n";
foreach ($listItems as $item) {
	$shoppingCart->addItem($item);
}
// hiển thị giỏ hàng và tổng tiền sản phẩm
$shoppingCart->displayCart();
// xoá thử 1 mặt hàng
echo "Xoá sản phẩm:\n";
$shoppingCart->removeItem("meat");
$shoppingCart->removeItem("orange"); // xoá sản phẩm không tồn tại
// hiển thị lại giỏ hàng
echo "\nGiỏ hàng sau khi xoá:","\n";
$shoppingCart->displayCart();
?>