package acciones;

import com.opensymphony.xwork2.ActionSupport;
import com.opensymphony.xwork2.validator.annotations.RequiredStringValidator;
import java.util.Map;
import org.apache.struts2.interceptor.SessionAware;
import persistencia.CategoriaDAO;
import pojos.Categoria;

public class CrearCategoria extends ActionSupport implements SessionAware {

    Map<String, Object> SESION;
    
    private String nombreCategoria, colorBorde, colorFondo;

    public CrearCategoria() {
    }

    public String getNombreCategoria() {
        return nombreCategoria;
    }

    @RequiredStringValidator(key = "campo.requerido")
    public void setNombreCategoria(String nombreCategoria) {
        this.nombreCategoria = nombreCategoria;
    }

    public String getColorBorde() {
        return colorBorde;
    }

    @RequiredStringValidator(key = "campo.requerido")
    public void setColorBorde(String colorBorde) {
        this.colorBorde = colorBorde;
    }

    public String getColorFondo() {
        return colorFondo;
    }

    @RequiredStringValidator(key = "campo.requerido")
    public void setColorFondo(String colorFondo) {
        this.colorFondo = colorFondo;
    }
    
    @Override
    public String execute() throws Exception {
        
        Categoria c = new CategoriaDAO().read(getNombreCategoria());
       
        
        if (c != null)
        {
            c.setColorBorde(getColorBorde());
            c.setColorFondo(getColorFondo());
            new CategoriaDAO().update(c);
        }else{
            
            c = new Categoria();
            c.setNombre(getNombreCategoria());
            c.setColorBorde(getColorBorde());
            c.setColorFondo(getColorFondo());
            new CategoriaDAO().create(c);
        }
        
                
        getSESION().put("CATEGORIAS",  new CategoriaDAO().list());
        
        return SUCCESS;
    }

    public Map<String, Object> getSESION() {
        return SESION;
    }

    @Override
    public void setSession(Map<String, Object> map) {
        this.SESION = map;
    }

}
