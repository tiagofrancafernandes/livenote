<?php

return [
    /**
     * If need confirm before to delete a note
     */
    'confirm_to_delete' => env('CONFIRM_TO_DELETE_NOTE', true),

    /**
     * If need confirm before to reset a note to initial value
     */
    'confirm_to_reset' => env('CONFIRM_TO_RESET_NOTE', true),
];