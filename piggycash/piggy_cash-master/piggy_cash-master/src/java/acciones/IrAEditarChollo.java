package acciones;

import com.opensymphony.xwork2.ActionSupport;
import java.text.SimpleDateFormat;
import java.util.Map;
import org.apache.struts2.interceptor.SessionAware;
import persistencia.ProductoDAO;
import pojos.Producto;
import pojos.Usuario;

public class IrAEditarChollo extends ActionSupport implements SessionAware{
    
    //Atributos recibidos
    private String idProducto;
    
    //Atributos enviados
    Producto p;
    private String fechaVencimiento;
    
    Map<String, Object> SESION;
    
    public IrAEditarChollo() {
    }

    public String getIdProducto() {
        return idProducto;
    }

    public void setIdProducto(String idProducto) {
        this.idProducto = idProducto;
    }

    public Producto getP() {
        return p;
    }

    public void setP(Producto p) {
        this.p = p;
    }

    public String getFechaVencimiento() {
        return fechaVencimiento;
    }

    public void setFechaVencimiento(String fechaVencimiento) {
        this.fechaVencimiento = fechaVencimiento;
    }
    
    public String execute() throws Exception {
        
        Usuario u = (Usuario) getSESION().get("USUARIO");
        Producto prod = new ProductoDAO().read(Integer.parseInt(getIdProducto()));
        
        
        if(prod.getUsuario().getUsuario().equals(u.getUsuario())){
            setP(prod); 
            setFechaVencimiento(new SimpleDateFormat("dd/MM/yyyy").format(getP().getFechaVencimiento()));
            return SUCCESS;
        }
        
        return ERROR;
    }
    
    @Override
    public void setSession(Map<String, Object> map) {
        this.SESION = map;
    }

    public Map<String, Object> getSESION() {
        return SESION;
    }
    
}
