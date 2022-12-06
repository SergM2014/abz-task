Livewire.on('laraveltable:action:confirm', (actionType, actionIdentifier, modelPrimary, confirmationQuestion) => {
    // You can replace this native JS confirm dialog by your favorite modal/alert/toast library implementation. Or keep it this way!
   
    if (window.confirm(confirmationQuestion)) {
        // As explained above, just send back the 3 first argument from the `table:action:confirm` event when the action is confirmed
        Livewire.emit('laraveltable:action:confirmed', actionType, actionIdentifier, modelPrimary);
    }
})