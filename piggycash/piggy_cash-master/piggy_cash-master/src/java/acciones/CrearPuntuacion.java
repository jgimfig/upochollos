package acciones;

import com.opensymphony.xwork2.ActionSupport;
import java.util.Map;
import org.apache.struts2.interceptor.SessionAware;
import persistencia.ProductoDAO;
import persistencia.PuntuaDAO;
import pojos.Producto;
import pojos.Puntua;
import pojos.Usuario;

public class CrearPuntuacion extends ActionSupport implements SessionAware{

    
    private String idProducto;
    private String puntuacion;
    
    Map<String, Object> SESION;
    
    
    public CrearPuntuacion() {
    }

    public String getIdProducto() {
        return idProducto;
    }

    public void setIdProducto(String idProducto) {
        this.idProducto = idProducto;
    }

    public String getPuntuacion() {
        return puntuacion;
    }

    public void setPuntuacion(String puntuacion) {
        this.puntuacion = puntuacion;
    }
    
    
    
    @Override
    public String execute() throws Exception {
       
         Usuario u = (Usuario) getSESION().get("USUARIO");
         
         Producto p = new ProductoDAO().read(Integer.parseInt(getIdProducto().trim()));
         Puntua puntuacion = new Puntua();
         
         //Rescatamos el porcerntaje de estrellas seleccionado por el usuario 0%-100%
         int puntos = Integer.parseInt(getPuntuacion().replace("%", ""));
         
         //Y lo pasamos de escala de 0 a 5 estrellas 
         puntos = (int) (Math.ceil(puntos/20f));
         
        if (u != null)
        {
            puntuacion.setUsuario(u);
            puntuacion.setProducto(p);
            puntuacion.setPuntuacion(puntos);
            
            new PuntuaDAO().create(puntuacion);
        }
         
         return SUCCESS;
    }
    
    
    @Override
    public void setSession(Map<String, Object> map) {
        this.SESION = map;
    }

    public Map<String, Object> getSESION() {
        return SESION;
    }
    
}
