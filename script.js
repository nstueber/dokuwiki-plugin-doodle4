/**
 * JavsScript methods for the dokuwiki doodle plugin
 * 
 * @author  Nico Stueber <nstueber@v-markt.de>
 * @author  Robert Rackl <spam11@doogie.de>
 * @date    February 2019
 */

/**
 * edit an entry
 * @param formId Id of the form tag
 * @param fullname name of the entry that should be edited
 */
function editEntry(formId, fullname) {
    var doodleForm = document.getElementById(formId);
    doodleForm.formId = formId;
    doodleForm.edit__entry.value = fullname;
    doodleForm.submit();
}
                                        
/** 
 * delete the given entry 
 * @param formId Id of the form tag
 * @param fullname name of the entry that should be edited
 */
function deleteEntry(formId, fullname) {
    var doodleForm = document.getElementById(formId);
    doodleForm.formId = formId;
    doodleForm.delete__entry.value = fullname;
    doodleForm.submit();
}
