package acciones;

import com.opensymphony.xwork2.ActionSupport;
import java.util.List;
import persistencia.TiendaDAO;
import pojos.Tienda;


public class CargarTiendasAction extends ActionSupport {
    
    private String datosTiendas;
    
    public CargarTiendasAction() {
    }

    public String getDatosTiendas() {
        return datosTiendas;
    }

    public void setDatosTiendas(String datosTiendas) {
        this.datosTiendas = datosTiendas;
    }
    
    @Override
    public String execute() throws Exception {
     
        
        /*
        SE MANDA A UN JSP QUE HACE LAS VECES DE DATA HANDLER, SE MANDA LA INFORMACIÓN DE FORMA ASINCRONA
        MEDIANTE AJAX
        */
        
        List<Tienda> tiendas = new TiendaDAO().list();
        String msg = "";
        
        for(Tienda tienda : tiendas)
        {
            msg += tienda.getNombre().replace(" ","-")+","+tienda.getLogo() + ";";
        }
        
        setDatosTiendas(msg);
        
        
        return SUCCESS;
    }
    
}
