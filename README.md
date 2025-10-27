# Vehicle Expenses API (Laravel)

## Install
1. Clone repo: `git clone https://github.com/Abdelrhmanakram/vehicle-s_expenses_list.git`
2. Copy env: `cp .env.example .env` and configure DB credentials
3. Install: `composer install`
4. Serve: `php artisan serve`

## Endpoint
GET `/api/vehicle-expenses`

## Query parameters
- `vehicle_name` (string) partial match
- `type[]` (string) allowed: `fuel`, `insurance`, `service`
- `min_cost`, `max_cost` (number)
- `min_date`, `max_date` (date string)
- `sort` (`cost` or `created_at`)
- `direction` (`asc` or `desc`)
- `per_page` (int, default 20)

## Example
`/api/vehicle-expenses?vehicle_name=Lorenzo&type[]=fuel&min_cost=100&sort=cost&direction=desc&per_page=50`

## Rate limiting
Endpoint limited to 5 requests per minute via `throttle` middleware.

## Tests
Run: `php artisan test`
