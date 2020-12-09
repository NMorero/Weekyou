$("#relationshipSelect1").change(function() {
    changeSelect(1);
});

$("#relationshipSelect2").change(function() {
    changeSelect(2);
});

$("#relationshipSelect3").change(function() {
    changeSelect(3);
});

$("#relationshipSelect4").change(function() {
    changeSelect(4);
});

function changeSelect(id) {
    let value = document.getElementById("relationshipSelect" + id).value;
    console.log(value);
    let form = document.getElementById("relationForm" + id);

    if (value == 1) {
        form.innerHTML = ` <div class="form-group">
        <label for="company_labor_relationship">Company labor relationship</label>
        <input type="text" name="company_labor_relationship" class="form-control" id="company_labor_relationship" aria-describedby="company_labor_relationship" >

    </div>
    <div class="form-group">
        <label for="social_work">Social work</label>
        <input type="text" name="social_work" class="form-control" id="social_work" aria-describedby="social_work" >

    </div>
    <div class="form-group">
        <label for="labor_union">Labor union</label>
        <input type="text" name="labor_union" class="form-control" id="labor_union" aria-describedby="labor_union" >

    </div>

    <div class="form-group">
        <label for="labor_agreement">Labor agreement</label>
        <input type="text" name="labor_agreement" class="form-control" id="labor_agreement" aria-describedby="labor_agreement" >

    </div>

    <div class="form-group">
        <label for="ivaCondition">IVA Condition</label>
        <input type="text" name="ivaCondition" class="form-control" id="ivaCondition" aria-describedby="ivaCondition" >

    </div>
    <div class="form-group">
        <label for="account_bank">Account bank</label>
        <input type="text" name="account_bank" class="form-control" id="account_bank" aria-describedby="account_bank" >

    </div>
    <div class="form-group">
        <label for="account_number">Account number</label>
        <input type="text" name="account_number" class="form-control" id="account_number" aria-describedby="account_number" >

    </div>

    <div class="form-group">
        <label for="cbu_number">CBU</label>
        <input type="text" name="cbu_number" class="form-control" id="cbu_number" aria-describedby="cbu_number" >

    </div>
    <div class="form-group">
        <label for="familyContact_name">Family contact name</label>
        <input type="text" name="familyContact_name" class="form-control" id="familyContact_name" aria-describedby="familyContact_name" >

    </div>
    <div class="form-group">
        <label for="familyContact_phoneNumber">Family contact phone number</label>
        <input type="text" name="familyContact_phoneNumber" class="form-control" id="familyContact_phoneNumber" aria-describedby="familyContact_phoneNumber" >

    </div>
    <div class="form-group">
        <label for="familyContact_address">Family contact address</label>
        <input type="text" name="familyContact_address" class="form-control" id="familyContact_address" aria-describedby="familyContact_address" >

    </div>




        `;
    } else if (value == 2) {
        form.innerHTML = `<div class="form-group">
        <label for="ivaCondition2">IVA Condition</label>
        <input type="text" name="ivaCondition2" class="form-control" id="ivaCondition2" aria-describedby="ivaCondition2" >

    </div>
    <div class="form-group">
        <label for="account_bank2">Account bank</label>
        <input type="text" name="account_bank2" class="form-control" id="account_bank2" aria-describedby="account_bank2" >

    </div>
    <div class="form-group">
        <label for="account_number2">Account number</label>
        <input type="text" name="account_number2" class="form-control" id="account_number2" aria-describedby="account_number2" >

    </div>

    <div class="form-group">
        <label for="cbu_number2">CBU</label>
        <input type="text" name="cbu_number2" class="form-control" id="cbu_number2" aria-describedby="cbu_number2" >

    </div>
    <div class="form-group">
        <label for="familyContact_name2">Family contact name</label>
        <input type="text" name="familyContact_name2" class="form-control" id="familyContact_name2" aria-describedby="familyContact_name2" >

    </div>
    <div class="form-group">
        <label for="familyContact_phoneNumber2">Family contact phone number</label>
        <input type="text" name="familyContact_phoneNumber2" class="form-control" id="familyContact_phoneNumber2" aria-describedby="familyContact_phoneNumber2" >

    </div>
    <div class="form-group">
        <label for="familyContact_address">Family contact address</label>
        <input type="text" name="familyContact_address2" class="form-control" id="familyContact_address2" aria-describedby="familyContact_address2" >

    </div>`;
    }
}
