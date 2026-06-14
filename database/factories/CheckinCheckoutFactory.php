<?php

namespace Database\Factories;

use App\Models\CheckinCheckout;
use App\Models\Reservasi;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CheckinCheckoutFactory extends Factory
{
    protected $model = CheckinCheckout::class;

    public function definition(): array
    {
        return [
            'id_reservasi'          => Reservasi::factory(),           // Otomatis buat reservasi jika belum ada
            'waktu_checkin'         => $this->faker->dateTimeBetween('-10 days', 'now'),
            'waktu_checkout'        => $this->faker->dateTimeBetween('now', '+15 days'),
            'waktu_checkin_aktual'  => $this->faker->optional()->dateTimeBetween('-10 days', 'now'),
            'waktu_checkout_aktual' => $this->faker->optional()->dateTimeBetween('now', '+10 days'),

            'status'                => $this->faker->randomElement([
                'pending', 'checked_in', 'checked_out', 'late_checkout', 'cancelled'
            ]),

            'deposit'               => $this->faker->randomFloat(2, 500000, 2000000),
            'biaya_tambahan'        => $this->faker->randomFloat(2, 0, 500000),
            'denda_late_checkout'   => $this->faker->randomFloat(2, 0, 300000),
            'total_bayar'           => $this->faker->randomFloat(2, 1000000, 5000000),

            'jumlah_tamu_aktual'    => $this->faker->numberBetween(1, 8),
            'kondisi_kamar'         => $this->faker->randomElement(['Bersih', 'Sangat Bersih', 'Ada Kerusakan', 'Normal']),
            'is_late_checkout'      => $this->faker->boolean(20), // 20% kemungkinan late checkout

            'catatan'               => $this->faker->optional()->sentence(10),
            'catatan_checkout'      => $this->faker->optional()->sentence(8),

            'created_by'            => User::factory(),
            'checked_in_by'         => User::factory(),
            'checked_out_by'        => User::factory(),
        ];
    }

    // State untuk kasus khusus
    public function checkedIn(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'checked_in',
            'waktu_checkin_aktual' => now()->subHours(rand(1, 24)),
        ]);
    }

    public function checkedOut(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'checked_out',
            'waktu_checkout_aktual' => now(),
        ]);
    }

    public function lateCheckout(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'late_checkout',
            'is_late_checkout' => true,
            'denda_late_checkout' => 250000.00,
        ]);
    }
}
