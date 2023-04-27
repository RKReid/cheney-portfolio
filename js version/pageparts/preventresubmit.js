//stops resubmit box https://stackoverflow.com/questions/6833914/how-to-prevent-the-confirm-form-resubmission-dialog
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}