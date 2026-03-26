<?php

/**
 * 1. Створення інтерфейсу для банківського рахунку
 */
interface AccountInterface {
    public function deposit(float $amount);
    public function withdraw(float $amount);
    public function getBalance(): float;
}

/**
 * 2. Створення базового класу з константою та обробкою винятків
 */
class BankAccount implements AccountInterface {
    protected float $balance;
    protected string $currency;
    const MIN_BALANCE = 0; // міні баланс

    public function __construct(float $initialBalance, string $currency = "UAH") {
        if ($initialBalance < self::MIN_BALANCE) {
            throw new Exception("Початковий баланс не може бути меншим за " . self::MIN_BALANCE);
        }
        $this->balance = $initialBalance;
        $this->currency = $currency;
    }

    public function deposit(float $amount): void {
        if ($amount <= 0) {
            throw new Exception("Сума поповнення повинна бути додатною ($amount).");
        }
        $this->balance += $amount;
        echo "Поповнено на $amount {$this->currency}. Баланс: {$this->balance} {$this->currency}.<br>";
    }

    public function withdraw(float $amount): void {
        if ($amount <= 0) {
            throw new Exception("Сума зняття повинна бути додатною ($amount).");
        }
        if (($this->balance - $amount) < self::MIN_BALANCE) {
            throw new Exception("Недостатньо коштів! Спроба зняти $amount {$this->currency}, але на рахунку лише {$this->balance} {$this->currency}.");
        }
        $this->balance -= $amount;
        echo "Знято $amount {$this->currency}. Залишок: {$this->balance} {$this->currency}.<br>";
    }

    public function getBalance(): float {
        return $this->balance;
    }

    public function getCurrency(): string {
        return $this->currency;
    }
}

/**
 * 3. Спадкування та статичні властивості
 */
class SavingsAccount extends BankAccount {
    public static float $interestRate = 0.07;

    public function applyInterest(): void {
        $interest = $this->balance * self::$interestRate;
        $this->balance += $interest;
        echo "Нараховано відсотки (+ " . (self::$interestRate * 100) . "%): $interest {$this->currency}. Новий баланс: {$this->balance} {$this->currency}.<br>";
    }
}

/**
 * 4. Тестування та обробка винятків
 */
try {
    echo "<h3>BankAccount (USD)</h3>";
    $myAccount = new BankAccount(150, "USD");
    $myAccount->deposit(50);
    $myAccount->withdraw(30);

    // Спроба зняти забагато коштів (виняток)
    // $myAccount->withdraw(500);

    echo "<h3>SavingsAccount (UAH)</h3>";
    $savings = new SavingsAccount(1000, "UAH");
    $savings->applyInterest(); // Нарахування 7%
    $savings->withdraw(200);

    echo "<h3>3. Перевірка обробки помилок</h3>";
    // Спроба поповнити на від'ємну суму
    $savings->deposit(-50);

} catch (Exception $e) {
    echo "<strong >ПОМИЛКА:</strong> " . $e->getMessage();
    echo "</div>";
} finally {
    echo "<br><hr><b>Виконання завершено.</b>";
}

?>