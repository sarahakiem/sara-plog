<h1>Laravel Queues</h1>
<p>
-Laravel provides a unified API for handling queued jobs across different queue backends like Amazon SQS, Redis, and databases, allowing tasks such as file processing to be executed in the background for better performance. The configuration for these queues is stored in config/queue.php<br><br>
-Laravel offers "connections" to backend services and multiple "queues" for organizing jobs. By using the php artisan queue:work command, you can prioritize job processing.Different queue drivers, such as the database and Redis, have specific prerequisites and configurations<br>
-The database driver requires a jobs table, while Redis requires a Redis connection configuration.<br>
-Redis can also use the block_for option to control the waiting time for jobs<br>
-php artisan make:job->to generate job classes,,These classes implement the ShouldQueue interface, enabling asynchronous job execution.<br>
-The 'handle' method processes jobs, with dependencies automatically injected by Laravel’s service container.
</p><br>

</h2>Unique Jobs in Laravel Queues</h2><br><br>
-Laravel allows you to ensure that only one instance of a specific job is on the queue at any point in time by implementing the 'ShouldBeUnique' interface on the job class. This prevents the job from being dispatched if another instance of the same job is already in the queue and not yet finished.<br>
-we can further customize the uniqueness by defining a specific "key" that makes the job unique or by specifying a timeout beyond which the job is no longer considered unique. This is done using the uniqueId method and the uniqueFor property.

*uniqueId Method: Specifies the unique identifier for the job. For example, you can make the job unique based on a product ID.<br>
*uniqueFor Property: Sets the duration (in seconds) after which the job's unique lock will expire. For instance, setting it to 3600 seconds means the lock will be released after one hour if the job has not been processed, allowing another job with the same unique key to be dispatched.<br><br><br>

Dispatching Jobs in Laravel<br>
-Once a job class is created, it can be dispatched using the dispatch method.->ProcessPodcast::dispatch($podcast);<br>
Queue Drivers<br>
-"sync" queue driver used by default, which executes jobs synchronously. For background processing, you need to specify a different driver in config/queue.php.
<br>
Delayed Dispatching<br>
-Jobs can be delayed using the delay method to prevent them from being processed immediately<br>
Dispatching After Response<br>
-Jobs can be dispatched after the HTTP response is sent to the browser using dispatchAfterResponse, useful for quick tasks like sending emails:<br>
<h1>Manually Releasing and Failing Jobs</h1>
-Manually Releasing a Job<br>
'release' method used to elease a job back onto the queue for reattempt.<br>
Manually Failing a Job<br>
-fail method used to To fail a job due to a caught exception, pass the exception or an error message.
<h1>Job Batching</h1>
-Laravel's job batching feature allows you to execute a batch of jobs and perform an action when all jobs in the batch have completed. To use job batching, first create a database migration to store batch metadata<br>
Dispatching Batches:-<br>
use the batch method of the Bus facade. we can use the 'then', 'catch', and 'finally' methods to define callbacks for various batch completion scenarios.









