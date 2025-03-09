Queue Processing Challenge

Objective: This challenge evaluates your ability to handle queue processing and optimization in PHP (Laravel). Your task is to implement and debug a job queue system that processes order payments efficiently.

Instructions:
Use PHP with Laravel with sail.
Use MySQL as the database.
Ensure queue workers are implemented correctly.
Write at least one unit test to verify job processing.
Include a README.md explaining:
How to set up and run the project.
Any issues you encountered and how you handled them.
Possible optimizations if given more time.
Submit your solution as a GitHub repository link or a compressed file via email.

Task: Implement an Order Processing Queue
1. Database Setup
Create an orders table with fields:
id (Primary Key, Auto Increment)
user_id (Foreign Key to users table)
amount (Decimal, Required)
status (Enum: pending, processing, completed, failed, Default: pending)
created_at, updated_at (Timestamps)
2. Queue Job: Process Order Payment
Create a job ProcessOrderPayment that:
Receives an order_id.
Updates order status to processing.
Simulates an external payment API call (use sleep(2) to mimic delay).
Randomly marks the order as completed or failed.
Logs success or failure.
3. Queue Worker Setup
Ensure jobs are queued and processed asynchronously.
Configure retry mechanism for failed jobs.
Handle dead-letter queues (if using Laravel Horizon, configure failed job handling).
4. Unit Test
Write a unit test to verify that:
The job processes orders correctly.
Orders transition from pending → processing → completed or failed.
Failed jobs are retried properly.

Evaluation Criteria
Correctness – Proper queue job handling and order status updates.
Performance – Efficient job processing and retries.
Robustness – Handling failures and ensuring retries work.
Testing – A working unit test for queue processing.
Documentation – Clear setup instructions.
