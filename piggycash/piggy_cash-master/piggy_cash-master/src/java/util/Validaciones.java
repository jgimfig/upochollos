package util;

public class Validaciones {
    
    /*
        CLASE CON VALIDACIONES VARIAS QUE SE UTILIZARÁN EN LOS FORMULARIOS DEL PROYECTO
    */

    public static boolean isEmailValid(String email) {
        String regex = "^[\\w-_\\.+]*[\\w-_\\.]\\@([\\w]+\\.)+[\\w]+[\\w]$";
        return email.matches(regex);
    }

}
