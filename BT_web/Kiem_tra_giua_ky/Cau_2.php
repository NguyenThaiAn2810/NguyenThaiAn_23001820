<?php
class CartItem {
    public $name;
    public $price;

    public function __construct($name, $price) {
        $this->name = $name;
        $this->price = $price;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getPrice() {
        return $this->price;
    }
    public function printProduct() {
        echo "Item: Name: " . $this->name .
            ". Price: " . $this->price . "\n";
    }
}
class ShoppingCart
{
    private array $items;

    public function __construct()
    {
        $this->items = [];
    }

    public function addItem(CartItem $item)
    {
        // chỉ thêm sản phẩm có price và quantity > 0
        if ($item->price <= 0) {
            echo "Không thể thêm '{$item->name}': Đơn giá phải lớn hơn 0.\n";
        } else {
            $this->items[] = $item;
            echo "Đã thêm '{$item->name}' vào giỏ hàng.\n";
        }
    }


    public function calculateTotal()
    {
        $total = 0;
        // nếu không có sản phẩm, trả về 0
        if (empty($this->items)) {
            return 0;
        }
        foreach ($this->items as $item) {
            $total += $item->getPrice();
        }
        return $total;
    }

    public function displayCart()
    {
        echo "Danh sách sản phẩm:", "\n";
        if (empty($this->items)) {
            echo "Giỏ hàng đang trống.\n";
        } else {
            foreach ($this->items as $item) {
                echo "Item: Name: " . $item->name .
                    ". Price: " . $item->price . "\n";
            }
            echo "Total amount: ", $this->calculateTotal(), "\n";
        }
    }

    public function findMaxPrice() {
        // nếu không có sản phẩm (mảng trống), trả về null
        if (empty($this->items)) {
            echo "Giỏ hàng đang trống, không tìm thấy sản phẩm";
            return null;
        }
        $maxPrice = -99999;
        $maxProduct = null;
        foreach ($this->items as $item) {
            if ($item->getPrice() > $maxPrice) {
                $maxPrice = $item->getPrice();
                $maxProduct = $item;
            }
        }
        return $maxProduct;
    }
}
// tạo 1 object ShoppingCart và 1 vài CartItem
$shoppingCart = new ShoppingCart();
$listItems = [
    $item1 = new CartItem("rice", 20),
    $item2 = new CartItem("meat", 40),
    $item3 = new CartItem("cake", 50),
    $item4 = new CartItem("cabbage", 15),
    $item5 = new CartItem("banana", 20)
];
// thêm hàng vào giỏ
echo "Thêm sản phẩm:\n";
foreach ($listItems as $item) {
    $shoppingCart->addItem($item);
}
// hiển thị giỏ hàng và tổng giá sản phẩm
$shoppingCart->displayCart();
// hiển thị sản phẩm giá trị cao nhất
$maxProduct = $shoppingCart->findMaxPrice();
echo "Sản phẩm giá trị cao nhất: ", $maxProduct->printProduct(), "\n";
?>
