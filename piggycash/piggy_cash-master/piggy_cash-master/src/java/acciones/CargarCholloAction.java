package acciones;

import com.opensymphony.xwork2.ActionSupport;
import java.util.List;
import persistencia.ComentarioDAO;
import persistencia.ProductoDAO;
import persistencia.PuntuaDAO;
import pojos.Comentario;
import pojos.Producto;
import pojos.Usuario;

public class CargarCholloAction extends ActionSupport {

    //Rrecibimos
    private String id;

    //Enviamos
    private Producto p;
    private List<Comentario> comentarios;
    private Integer puntuacion;

    public CargarCholloAction() {
    }

    public Integer getPuntuacion() {
        return puntuacion;
    }

    public void setPuntuacion(Integer puntuacion) {
        this.puntuacion = puntuacion;
    }

    public List<Comentario> getComentarios() {
        return comentarios;
    }

    public void setComentarios(List<Comentario> comentarios) {
        this.comentarios = comentarios;
    }

    public String getId() {
        return id;
    }

    public void setId(String id) {
        this.id = id;
    }

    public Producto getP() {
        return p;
    }

    public void setP(Producto p) {
        this.p = p;
    }

    @Override
    public String execute() throws Exception {

        /*
            Recibe el id de un chollo y lo muestra integro en su página correspondiente.
        */
        
        setP(new ProductoDAO().read(Integer.parseInt(getId())));
        setComentarios(new ComentarioDAO().list(getId()));
        setPuntuacion(calcularPuntuacionProducto());

        try {

            if (getP() == null) {
                return ERROR;
            }
        } catch (Exception e) {
            return ERROR;
        }

        return SUCCESS;
    }

    public Integer calcularPuntuacionProducto() {

        List<Usuario> usuarios = new PuntuaDAO().getElemento2(getP());

        int puntos = 0;

        for (Usuario usuario : usuarios) {
            puntos += new PuntuaDAO().getAttribute(getP(), usuario);
        }

        int puntuacionMaxima = 5 * usuarios.size();

        if (puntuacionMaxima <= 0) {
            return 0;
        }

        return (puntos * 100) / puntuacionMaxima;
    }

}
