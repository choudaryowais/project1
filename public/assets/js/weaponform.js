// Function to automatically set weapon type based on weapon name
function updateWeaponType() {
    var weaponName = document.getElementById("weapon_name").value;
    var weaponType = document.getElementById("weapon_type");

    // Check which weapon name is selected and update weapon type
    if (weaponName === "SMG(AK-47)" || weaponName === "G3" || weaponName === "MP-5") {
        weaponType.value = "gun";  // Set type to gun
    } else if (weaponName === "Beretta" || weaponName === "Glock" || weaponName === "Revolver") {
        weaponType.value = "pistol";  // Set type to pistol
    }
}

// Call updateWeaponType when the page loads or when the weapon_name is changed
window.onload = updateWeaponType;  // Set default value on page load