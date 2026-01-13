--
-- Banco de dados: `vvazul`
--

CREATE DATABASE IF NOT EXISTS vvazul;
USE vvazul;


-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_banner`
--

CREATE TABLE `tb_banner` (
  `codigo` int(11) NOT NULL,
  `img` varchar(100) NOT NULL,
  `alternativo` varchar(100) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  `orden` int(11) NOT NULL,
  `activo` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dados para a tabela `tb_banner`
--

INSERT INTO `tb_banner` (`codigo`, `img`, `alternativo`, `url`, `orden`, `activo`) VALUES
(1, 'banner1.png', 'Celebramos 32 años contigo', '#', 0, 1),
(2, 'banner-2020-07-18-banner2.png', 'Haga sus compras en la comodidad de tu casa.', 'catalogo.php?categoria=54', 1, 1);

--
-- Índices de tabela `tb_banner`
--
ALTER TABLE `tb_banner`
  ADD PRIMARY KEY (`codigo`);

--
-- AUTO_INCREMENT de tabela `tb_banner`
--
ALTER TABLE `tb_banner`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_categoria`
--

CREATE TABLE `tb_categoria` (
  `codigo` int(11) NOT NULL,
  `nombre` varchar(80) NOT NULL,
  `cod_padre` int(11) DEFAULT NULL,
  `menu` tinyint(1) NOT NULL,
  `activo` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dados para a tabela `tb_categoria`
--

INSERT INTO `tb_categoria` (`codigo`, `nombre`, `cod_padre`, `menu`, `activo`) VALUES
(1, 'Muebles', NULL, 1, 1),
(2, 'Sofas', 1, 1, 1),
(3, 'Bazar', NULL, 1, 1),
(4, 'Cubiertos', 3, 1, 1),
(5, 'Juego de ollas', 3, 1, 1),
(6, 'Mesa centro', 1, 1, 1),
(7, 'Muebles para cocina', 1, 1, 1),
(8, 'Portatiles', NULL, 1, 1),
(9, 'Cafeteras', 8, 1, 1),
(10, 'Licuadoras ', 8, 1, 1),
(11, 'Refrigeración', NULL, 1, 1),
(12, 'Heladeras ', 11, 1, 1),
(13, 'Bebederos', 11, 1, 1),
(14, 'Salud y Belleza', NULL, 1, 1),
(15, 'Corta pelo', 14, 1, 1),
(16, 'Nebulizador ', 14, 1, 1);

--
-- Índices de tabela `tb_categoria`
--
ALTER TABLE `tb_categoria`
  ADD PRIMARY KEY (`codigo`);

--
-- AUTO_INCREMENT de tabela `tb_categoria`
--
ALTER TABLE `tb_categoria`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_image`
--

CREATE TABLE `tb_image` (
  `codigo` int(11) NOT NULL,
  `url` varchar(80) NOT NULL,
  `cod_producto` varchar(20) NOT NULL,
  `orden` int(11) NOT NULL,
  `activo` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Despejando dados para a tabela `tb_image`
--

INSERT INTO `tb_image` (`codigo`, `url`, `cod_producto`, `orden`, `activo`) VALUES
(1, 'cod332420-2026-01-04-JuegoSofa.jpeg', '332420', 1, 1),
(2, 'cod343425-2026-01-05-sofas-california.jpg', '343425', 1, 1),
(3, 'cod343425-2026-01-05-sofa-rojo.png', '343425', 2, 1),
(4, 'cod31606-2026-01-05-sofa-abb.jpg', '31606', 1, 1),
(5, 'cod669031-2026-01-05-jgocubiertos.jpg', '669031', 1, 1),
(6, 'cod6600-2026-01-05-65510200PDM001G.jpg', '6600', 1, 1),
(7, 'cod11090-2026-01-05-mesacentro.png', '11090', 1, 1),
(8, 'cod32974-2026-01-05-mueblecocina.jpg', '32974', 1, 1),
(9, 'cod103087-2026-01-05-afeitadora.jpg', '103087', 1, 1),
(10, 'cod687257-2026-01-05-cafetera.jpg', '687257', 1, 1);

--
-- Índices de tabela `tb_image`
--
ALTER TABLE `tb_image`
  ADD PRIMARY KEY (`codigo`);

--
-- AUTO_INCREMENT de tabela `tb_image`
--
ALTER TABLE `tb_image`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_informaciones`
--

CREATE TABLE `tb_informaciones` (
  `codigo` int(11) NOT NULL,
  `whatsapp` varchar(20) NOT NULL,
  `facebook` varchar(80) NOT NULL,
  `instagram` varchar(80) NOT NULL,
  `email` varchar(80) NOT NULL,
  `titulo_pagina` varchar(80) NOT NULL,
  `conteudo_pagina` text NOT NULL,
  `horario_lunesviernes` varchar(80) NOT NULL,
  `horario_sabado` varchar(80) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dados para a tabela `tb_informaciones`
--

INSERT INTO `tb_informaciones` (`codigo`, `whatsapp`, `facebook`, `instagram`, `email`, `titulo_pagina`, `conteudo_pagina`, `horario_lunesviernes`, `horario_sabado`) VALUES
(1, '+55 51 00000 0000', 'https://www.facebook.com/', 'https://www.instagram.com/', 'seuemail@gmail.com', 'Historia', '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus, accusamus nemo? Perspiciatis inventore maiores nemo nisi sapiente itaque fugiat eaque earum. Dolore, alias consectetur! Atque optio fugiat eveniet neque rerum!</p>\r\n', '08:00 a 18:00', '08:00 a 12:00');

--
-- Índices de tabela `tb_informaciones`
--
ALTER TABLE `tb_informaciones`
  ADD PRIMARY KEY (`codigo`);
--
-- AUTO_INCREMENT de tabela `tb_informaciones`
--
ALTER TABLE `tb_informaciones`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;


-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_producto`
--

CREATE TABLE `tb_producto` (
  `codigo` varchar(20) NOT NULL,
  `nombre` varchar(80) NOT NULL,
  `descripcion` text NOT NULL,
  `estoque` int(11) NOT NULL,
  `precio` int(11) DEFAULT NULL,
  `ctd_cuota` int(11) DEFAULT NULL,
  `valor_cuota` int(11) DEFAULT NULL,
  `cod_categoria` int(11) NOT NULL,
  `destaque` tinyint(1) NOT NULL,
  `activo` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dados para a tabela `tb_producto`
--

INSERT INTO `tb_producto` (`codigo`, `nombre`, `descripcion`, `estoque`, `precio`, `ctd_cuota`, `valor_cuota`, `cod_categoria`, `destaque`, `activo`) VALUES
('332420', 'Jgo. De living Abba 15 años 3 lugares', 'Abba 15 años es un sofá con pillow de espuma siliconada en el asiento y sistema retráctil con rueditas para facilitar su apertura. Posee respalderos con mecanismo reclinable y almohadas fijas de hiper confort rellenos de fibra siliconada. Sus asientos son modulados y pueden ser fabricados de 0,80 cm  a 1.10 cm de largo. Puede recibir telas de las lineas 5 y 7.', 10, NULL, 16, 690000, 2, 0, 1),
('343425', 'JGO.DE LIVING CALIFORNIA TC L3 / TC B L3', 'California es un sofá esquinero con mucho estilo. Posee tres lugares incluyendo el esquinero y el chaise. Tiene dos asientos retráctiles con rueditas de silicona para facilitar su apertura, además sus asientos poseen Pillow Confort que es un extra en comodidad. Sus respalderos son con almohadas fijas, reclinables rellenos con fibra siliconada. Incluye 4 hermosas almohadas decorativas.', 5, 6165000, 16, 607000, 2, 0, 1),
('31606', 'SOFÁ ABRACCIA T L5/L7', 'Hecho con estructura de eucalipto reforestado\r\nSustentación en precinta italiana\r\nResorte pocket en la parte inferior de la espuma\r\nAsientos con espuma D23 combina lo firme y confortable', 2, NULL, 16, 534000, 2, 1, 1),
('669031', 'JUEGO DE CUBIERTOS TRAMONTINA ANGRA 79PZ', 'El Juego de Cubiertos Tramontina de acero inoxidable de 79 piezas de la línea Angra es completo para tu cocina. Son 79 piezas de gran durabilidad que aportan la calidad que solo el acero inoxidable puede ofrecer. También tienen un acabado brillante especial con detalles en el mango.', 15, 380000, NULL, NULL, 4, 0, 1),
('6600', 'Juego de Ollas 6 Piezas Solar Inox Tramontina', 'Juego de Ollas Tramontina', 25, 1000000, NULL, NULL, 5, 0, 1),
('11090', 'CONJUNTO DE MESAS DE CENTRO COLUMBIA', 'El juego de mesa de centro Columbia es una sinfonía de elegancia y funcionalidad que redefine el diseño contemporáneo. Cada pieza, elaborada con maestría en MDP BP de 15 mm, rinde homenaje a la durabilidad combinada con una estética refinada.', 6, 800000, NULL, NULL, 6, 0, 1),
('32974', 'BALCON 1200 C/TAMPO FIO FREIJO/GRAFITO', 'Fabricada en MDP de 12 y 15 mm\r\nPatas de PVC\r\nTiradores en ABS', 8, 150000, NULL, NULL, 7, 0, 1),
('103087', 'AFEITADORA BRITANIA BAP21P BIV', 'El corta pelo Britania BAP21P Multigroom 7 en 1 es el accesorio definitivo para el cuidado personal masculino. Cuenta con cuchillas lavables y de acero inoxidable, este dispositivo garantiza una vida útil prolongada y un rendimiento excepcional.', 1, 240000, NULL, NULL, 15, 0, 1),
('687257', 'CAFETERA MOULINEX DOLCE GUSTO MINI ME ROJA', 'Te enamorarás de su diseño exclusivo y moderno, su bomba de presión hasta 15 bares y su tecnología automática que te ofrecerán bebidas de calidad profesional.\r\n\r\n* Bomba de presion hasta 15 bares.\r\n\r\n* Compacta y automatica.', 12, 1015000, 16, 100000, 9, 0, 1);

--
-- Índices de tabela `tb_producto`
--
ALTER TABLE `tb_producto`
  ADD PRIMARY KEY (`codigo`);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_promo_producto`
--

CREATE TABLE `tb_promo_producto` (
  `codigo` int(11) NOT NULL,
  `cod_promocion` int(11) NOT NULL,
  `cod_producto` varchar(20) NOT NULL,
  `precio` int(11) DEFAULT NULL,
  `cuota` int(11) DEFAULT NULL,
  `valor` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dados para a tabela `tb_promo_producto`
--

INSERT INTO `tb_promo_producto` (`codigo`, `cod_promocion`, `cod_producto`, `precio`, `cuota`, `valor`) VALUES
(1, 1, '332420', NULL, 15, 690000),
(2, 1, '343425', NULL, NULL, NULL),
(3, 1, '31606', NULL, NULL, NULL);

--
-- Índices de tabela `tb_promo_producto`
--
ALTER TABLE `tb_promo_producto`
  ADD PRIMARY KEY (`codigo`);

--
-- AUTO_INCREMENT de tabela `tb_promo_producto`
--
ALTER TABLE `tb_promo_producto`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_promocion`
--

CREATE TABLE `tb_promocion` (
  `codigo` int(11) NOT NULL,
  `orden` int(11) NOT NULL,
  `img_fondo` varchar(100) DEFAULT NULL,
  `img` varchar(100) DEFAULT NULL,
  `titulo` varchar(100) NOT NULL,
  `activo` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dados para a tabela `tb_promocion`
--

INSERT INTO `tb_promocion` (`codigo`, `orden`, `img_fondo`, `img`, `titulo`, `activo`) VALUES
(1, 0, 'fondo-promo1.jpg', 'promo1.jpg', 'Promoción!', 1);

--
-- Índices de tabela `tb_promocion`
--
ALTER TABLE `tb_promocion`
  ADD PRIMARY KEY (`codigo`);

--
-- AUTO_INCREMENT de tabela `tb_promocion`
--
ALTER TABLE `tb_promocion`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_sucursales`
--

CREATE TABLE `tb_sucursales` (
  `codigo` int(11) NOT NULL,
  `nombre` varchar(80) NOT NULL,
  `ubicacion` varchar(100) NOT NULL,
  `ciudad` varchar(100) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `celular` varchar(20) DEFAULT NULL,
  `maps` varchar(400) NOT NULL,
  `activo` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dados para a tabela `tb_sucursales`
--

INSERT INTO `tb_sucursales` (`codigo`, `nombre`, `ubicacion`, `ciudad`, `telefono`, `celular`, `maps`, `activo`) VALUES
(1, 'Matriz', 'Calle', 'Ciudad del Este', '000 000-000', '0000 000 000', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d110741.50117699019!2d-54.75407149668259!3d-25.493383579681566!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94f68499feb6b1d1%3A0xce33cb9eeb700b1e!2sCidade%20do%20Leste%2C%20Paraguai!5e1!3m2!1spt-BR!2sbr!4v1768317385634!5m2!1spt-BR!2sbr', 1);

--
-- Índices de tabela `tb_sucursales`
--
ALTER TABLE `tb_sucursales`
  ADD PRIMARY KEY (`codigo`);

--
-- AUTO_INCREMENT de tabela `tb_sucursales`
--
ALTER TABLE `tb_sucursales`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_usuario`
--

CREATE TABLE `tb_usuario` (
  `codigo` int(11) NOT NULL,
  `usuario` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `nombre` varchar(80) NOT NULL,
  `papel` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dados para a tabela `tb_usuario`
--

INSERT INTO `tb_usuario` (`codigo`, `usuario`, `password`, `nombre`, `papel`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'Administrador', 0);

--
-- Índices de tabela `tb_usuario`
--
ALTER TABLE `tb_usuario`
  ADD PRIMARY KEY (`codigo`);

--
-- AUTO_INCREMENT de tabela `tb_usuario`
--
ALTER TABLE `tb_usuario`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;


-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_visitas`
--

CREATE TABLE `tb_visitas` (
  `codigo` int(11) NOT NULL,
  `tabla` varchar(80) NOT NULL,
  `cod_ref` varchar(20) DEFAULT NULL,
  `total_hits` int(11) NOT NULL,
  `unique_hits` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Índices de tabela `tb_visitas`
--
ALTER TABLE `tb_visitas`
  ADD PRIMARY KEY (`codigo`);

--
-- AUTO_INCREMENT de tabela `tb_visitas`
--
ALTER TABLE `tb_visitas`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

COMMIT;