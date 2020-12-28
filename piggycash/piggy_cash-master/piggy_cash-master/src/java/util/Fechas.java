package util;

import java.text.SimpleDateFormat;
import java.util.Date;

/*
    CLASE CON FUNCIONES REFERENTES A LA GESTIÓN DE FECHAS
*/

public class Fechas {
    
    public static String DateToString(Date d){
        
        SimpleDateFormat df = new SimpleDateFormat("dd/MM/YYYY");
        
        return df.format(d);
    }
    
    
}
