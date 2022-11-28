<?php //caa5926aceb7e3c8136a2a4d2baee301
/** @noinspection all */

namespace Illuminate\Notifications {

    use LaravelIdea\Helper\_BaseCollection;

    /**
     * @method DatabaseNotification|null getOrPut($key, $value)
     * @method DatabaseNotification|$this shift(int $count = 1)
     * @method DatabaseNotification|null firstOrFail(callable|string $key = null, $operator = null, $value = null)
     * @method DatabaseNotification|$this pop(int $count = 1)
     * @method DatabaseNotification|null pull($key, \Closure $default = null)
     * @method DatabaseNotification|null last(callable $callback = null, \Closure $default = null)
     * @method DatabaseNotification|$this random(callable|int|null $number = null)
     * @method DatabaseNotification|null sole(callable|string $key = null, $operator = null, $value = null)
     * @method DatabaseNotification|null get($key, \Closure $default = null)
     * @method DatabaseNotification|null first(callable $callback = null, \Closure $default = null)
     * @method DatabaseNotification|null firstWhere(callable|string $key, $operator = null, $value = null)
     * @method DatabaseNotification|null find($key, $default = null)
     * @method DatabaseNotification[] all()
     */
    class DatabaseNotificationCollection extends _BaseCollection {
        /**
         * @param int $size
         * @return DatabaseNotification[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }
}
