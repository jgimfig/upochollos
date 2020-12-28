package acciones;

import com.opensymphony.xwork2.ActionSupport;
import java.util.List;
import persistencia.CuponDAO;
import pojos.Cupon;
import util.Fechas;

public class CargarCuponesAction extends ActionSupport {

    private String datosCupon;

    public String getDatosCupon() {
        return datosCupon;
    }

    public void setDatosCupon(String datosCupon) {
        this.datosCupon = datosCupon;
    }

    public CargarCuponesAction() {
    }

    @Override
    public String execute() throws Exception {

        /*
        SE MANDA A UN JSP QUE HACE LAS VECES DE DATA HANDLER, SE MANDA LA INFORMACIÓN DE FORMA ASINCRONA
        MEDIANTE AJAX
        */
        
        datosCupon = "";

        List<Cupon> cupones = new CuponDAO().list();

        for (Cupon cupon : cupones) {
            datosCupon += cupon.getNombre()
                    + "_" + cupon.getDescripcion()
                    + "_" + Fechas.DateToString(cupon.getFechaPublicado())
                    + "_" + Fechas.DateToString(cupon.getFechaVencimiento())
                    + "_" + cupon.getCodigo()
                    + "_" + cupon.getId()
                    + "$";
        }

        if (datosCupon.length() > 1) {
            datosCupon = datosCupon.substring(0, datosCupon.length() - 1);
        }

        return SUCCESS;
    }

}
