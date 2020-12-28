package acciones;

import com.opensymphony.xwork2.ActionSupport;
import java.util.List;
import java.util.Map;
import org.apache.struts2.interceptor.SessionAware;
import persistencia.ComentarioDAO;
import persistencia.ProductoDAO;
import persistencia.PuntuaDAO;
import pojos.Comentario;
import pojos.Producto;
import pojos.Usuario;

public class EliminarComentario extends ActionSupport implements SessionAware {

    //Atributos que recibimos
    private String idProducto;
    private String idComentario;

    //Atributos que devolvemos
    private List<Comentario> comentarios;
    private Producto p;
    private Integer puntuacion;

    Map<String, Object> SESION;

    public EliminarComentario() {
    }

    public Integer getPuntuacion() {
        return puntuacion;
    }

    public void setPuntuacion(Integer puntuacion) {
        this.puntuacion = puntuacion;
    }

    public String getIdProducto() {
        return idProducto;
    }

    public void setIdProducto(String idProducto) {
        this.idProducto = idProducto;
    }

    public List<Comentario> getComentarios() {
        return comentarios;
    }

    public void setComentarios(List<Comentario> comentarios) {
        this.comentarios = comentarios;
    }

    public Producto getP() {
        return p;
    }

    public void setP(Producto p) {
        this.p = p;
    }

    public String getIdComentario() {
        return idComentario;
    }

    public void setIdComentario(String idComentario) {
        this.idComentario = idComentario;
    }

    public String execute() throws Exception {

        Usuario u = (Usuario) getSESION().get("USUARIO");
        Comentario c = new ComentarioDAO().read(Integer.parseInt(getIdComentario()));

        if (c.getUsuario().getUsuario().equals(u.getUsuario())) {
            new ComentarioDAO().delete(c);
        }

        setComentarios(new ComentarioDAO().list(getIdProducto()));
        setP(new ProductoDAO().read(Integer.parseInt(getIdProducto())));
        setPuntuacion(calcularPuntuacionProducto());

        return SUCCESS;
    }

    @Override
    public void setSession(Map<String, Object> map) {
        this.SESION = map;
    }

    public Map<String, Object> getSESION() {
        return SESION;
    }
    
  public Integer calcularPuntuacionProducto(){
        
        List <Usuario> usuarios = new PuntuaDAO().getElemento2(getP());
        
        int puntos = 0;
        
        for (Usuario usuario : usuarios)
        {
            puntos += new PuntuaDAO().getAttribute(getP(), usuario);
        }
                
        int puntuacionMaxima = 5*usuarios.size();
        
        if (puntuacionMaxima <= 0)
        {
           return 0;
        }
        
        return (puntos*100)/puntuacionMaxima;
    }

}
