<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Event;
use App\Models\Attendee;
use App\Models\Booking;

class BookingTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function it_allows_successful_booking()
    {
        $event = Event::factory()->create(['capacity' => 10]);
        $attendee = Attendee::factory()->create();

        $response = $this->postJson('/api/bookings', [
            'event_id' => $event->id,
            'attendee_id' => $attendee->id,
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('bookings', [
            'event_id' => $event->id,
            'attendee_id' => $attendee->id,
        ]);
    }

    /** @test */
    public function it_prevents_duplicate_bookings()
    {
        $event = Event::factory()->create(['capacity' => 10]);
        $attendee = Attendee::factory()->create();

        // First booking
        Booking::create([
            'event_id' => $event->id,
            'attendee_id' => $attendee->id,
        ]);

        // Attempt duplicate
        $response = $this->postJson('/api/bookings', [
            'event_id' => $event->id,
            'attendee_id' => $attendee->id,
        ]);

        $response->assertStatus(409); // Conflict
        $response->assertJson(['error' => 'Already booked']);
    }

    /** @test */
    public function it_prevents_overbooking_when_event_is_full()
    {
        $event = Event::factory()->create(['capacity' => 1]);

        // Book first attendee
        Booking::create([
            'event_id' => $event->id,
            'attendee_id' => Attendee::factory()->create()->id,
        ]);

        // Try booking a second attendee
        $secondAttendee = Attendee::factory()->create();

        $response = $this->postJson('/api/bookings', [
            'event_id' => $event->id,
            'attendee_id' => $secondAttendee->id,
        ]);

        $response->assertStatus(400); // Bad Request
        $response->assertJson(['error' => 'Event is full']);
    }
}
